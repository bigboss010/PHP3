@component('mail::message')
# Xác nhận địa chỉ email của bạn <br>

Xin chào {{ $user->name }}, <br>

Cảm ơn bạn đã đăng ký tài khoản tại cửa hàng của chúng tôi. <br>

Vui lòng nhấp vào nút bên dưới để xác nhận địa chỉ email của bạn.

@component('mail::button', ['url' => $verificationUrl])
Xác nhận email
@endcomponent

Nếu bạn không tạo tài khoản này, vui lòng bỏ qua email này.

Trân trọng,

Đội ngũ cửa hàng của chúng tôi

Hotline: 0334675867 <br>
Email: meliodas2sk@gmail.com
@endcomponent
