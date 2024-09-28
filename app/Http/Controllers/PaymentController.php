<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        $vnp_TmnCode = env('VNP_TMN_CODE'); // Mã website tại VNPAY
        $vnp_HashSecret = env('VNP_HASH_SECRET'); // Chuỗi bí mật
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
        $vnp_TxnRef = date('YmdHis'); // Mã giao dịch
        $vnp_OrderInfo = "Thanh toán nạp tiền vào tài khoản";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->input('amount') * 100; // VNPay yêu cầu số tiền theo đơn vị VND x100
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => Carbon::now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Bước 1: Sắp xếp các tham số theo thứ tự a->z trước khi tạo URL
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (env('VNP_HASH_SECRET')) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Bước 2: Chuyển hướng người dùng tới trang thanh toán VNPay
        return redirect($vnp_Url);
    }

    

    public function paymentReturn(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        
        if ($vnp_ResponseCode == "00") {
            // Thanh toán thành công
            $amount = $request->get('vnp_Amount') / 100; // Chuyển về đơn vị VNĐ
    
            // Lưu thông tin giao dịch vào bảng transactions
            Transaction::create([
                'user_id' => auth()->id(),
                'transaction_id' => $request->get('vnp_TxnRef'), // Mã giao dịch từ VNPay
                'amount' => $amount,
                'payment_method' => 'VNPay',
                'transaction_date' => now(),
            ]);
    
            // Cộng tiền vào tài khoản của người dùng
            $user = auth()->user();
            $user->balance += $amount;
            $user->save();
    
            return redirect()->route('payment.success')->with('success', 'Nạp tiền thành công');
        } else {
            return redirect()->route('payment.failed')->with('error', 'Thanh toán thất bại');
        }
    }
    

public function paymentSuccess()
{
    return view('payment.success');
}


}
