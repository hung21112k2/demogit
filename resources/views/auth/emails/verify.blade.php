<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận tài khoản của bạn</title>
</head>
<body>
    <h1>Xác nhận tài khoản của bạn</h1>
    <p>Chào {{ $user->username }},</p>
    <p>Vui lòng nhấp vào liên kết dưới đây để xác nhận tài khoản của bạn:</p>
    <a href="{{ $url }}">Xác nhận email</a>
    <p>Liên kết sẽ hết hạn trong 60 phút.</p>
    <p>Nếu bạn không yêu cầu tài khoản này, vui lòng bỏ qua email này.</p>
</body>
</html>
