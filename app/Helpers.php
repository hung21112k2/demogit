<?php

// Đây là file Helper để chứa các hàm tiện ích
if (!function_exists('maskPhoneNumber')) {
    function maskPhoneNumber($phone)
    {
        return substr($phone, 0, 6) . ' ***';
    }
}

if (!function_exists('maskEmail')) {
    function maskEmail($email)
    {
        $emailParts = explode('@', $email);
        return substr($emailParts[0], 0, 3) . '***@' . $emailParts[1];
    }
}
