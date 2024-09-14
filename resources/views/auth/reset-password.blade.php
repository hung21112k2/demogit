<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Mật khẩu mới:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Xác nhận mật khẩu:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Đặt lại mật khẩu</button>
</form>
