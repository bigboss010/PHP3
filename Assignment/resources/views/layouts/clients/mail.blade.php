@component('mail::message')
    # Xác nhận đơn hàng của bạn

    Xin chào {{ $donHang->ten_nguoi_nhan}},

    Cảm ơn bạn đã đặt đơn hàng thú cưng từ cửa hàng của chúng tôi. 

    Đây là thông tin chi tiết đơn hàng của bạn:

    * Mã đơn hàng *: {{ $donHang->ma_don_hang }}
    * Số điện thoại *: {{ $donHang->so_dien_thoai_nguoi_nhan }}
    * Địa chỉ *: {{ $donHang->dia_chi_nguoi_nhan }}
    * Ngày đặt *: {{ (New DateTime($donHang->ngay_dat))->format('H:i:s d/m/Y') }}
    * Đơn hàng bao gồm *:
    @foreach ($donHang->chiTietDonHang as $item)
        - {{ $item->pet->ten_pet }} x {{ $item->so_luong }}: {{ number_format($item->thanh_tien) }} VND
    @endforeach
    
    * Tổng tiền *: {{ number_format($donHang->tong_tien) }} VND

    Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xử lý đơn hàng.

    Hotline: 0334675867
    Email: meliodas2sk@gmail.com
    Trân trọng!

@endcomponent