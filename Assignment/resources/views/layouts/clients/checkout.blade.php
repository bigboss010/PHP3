@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a> <span class="mx-2 mb-0">/</span>
                    <a href="{{ route('/.cart') }}">Giỏ hàng</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Hóa đơn</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <form action="{{ route('donhangs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Thông tin chi tiết hóa đơn</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="deleted" value="0">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Họ và tên <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="ten_nguoi_nhan"
                                        value="{{ Auth::user()->name }}" >
                                    @error('ten_nguoi_nhan')
                                        <p>
                                        <div class="class-danger">{{ $message }}</div>
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Địa chỉ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="dia_chi_nguoi_nhan"
                                        value="{{ Auth::user()->address }}" >
                                </div>
                                @error('dia_chi_nguoi_nhan')
                                    <p>
                                    <div class="class-danger">{{ $message }}</div>
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email_address" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="email_nguoi_nhan"
                                        value="{{ Auth::user()->email }}" >
                                </div>
                                @error('email_nguoi_nhan')
                                    <p>
                                    <div class="class-danger">{{ $message }}</div>
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-12">
                                    <label for="c_phone" class="text-black">Số điện thoại <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="c_phone"
                                        name="so_dien_thoai_nguoi_nhan" value="{{ Auth::user()->phoneNumber }}" >
                                </div>
                                @error('so_dien_thoai_nguoi_nhan')
                                    <p>
                                    <div class="class-danger">{{ $message }}</div>
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Ghi chú</label>
                                <textarea name="ghi_chu" id="c_order_notes" cols="30" rows="5" class="form-control"
                                    placeholder="Viết ghi chú của bạn ở đây ....."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Mã giảm giá</h2>
                                <div class="p-3 p-lg-5 border">
                                    <!-- Coupon code input here -->
                                </div>
                            </div>
                        </div>



                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Hóa đơn của bạn</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">

                                        <thead>
                                            <th>Thú cưng</th>
                                            <th>Tổng tiền</th>
                                        </thead>
                                        <tbody>
                                            @if (!empty($cartItems))
                                                @foreach ($cartItems as $id => $details)
                                                    <tr>
                                                        <td>{{ $details['ten_pet'] }} <strong
                                                                class="mx-2 font-weight: normal;">x</strong>{{ $details['so_luong'] }}
                                                        </td>
                                                        <td>{{ number_format($details['gia_pet'] * $details['so_luong'], 0, ',', '.') }}
                                                            VNĐ</td>
                                                    </tr>
                                                @endforeach
                                                <tr>

                                                    <td class="text-black font-weight: normal;"><strong>Tổng phụ giỏ hàng</strong></td>
                                                    <td class="text-black">{{ number_format($subtotal, 0, ',', '.') }} VNĐ
                                                        {{-- <input type="hidden" name="tong_tien" value="{{$total}}"> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight: normal;"><strong>Tổng hóa
                                                            đơn</strong>
                                                    </td>
                                                    <td class="text-black font-weight: normal;">
                                                        <strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                                                        <input type="hidden" name="tong_tien" value="{{ $total }}">
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">Your cart is empty!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0" name="phuong_thuc_thanh_toan_id" value="1"><a class="d-block" data-toggle="collapse" href="#collapsebank"
                                                role="button" aria-expanded="false" name="phuong_thuc_thanh_toan_id" value="1" aria-controls="collapsebank">Thanh toán khi giao hàng</a></h3>

                                        <div class="collapse" id="collapsebank" name="phuong_thuc_thanh_toan_id" value="1">
                                            <div class="py-2" name="phuong_thuc_thanh_toan_id" value="1">
                                                <p class="mb-0" name="phuong_thuc_thanh_toan_id" value="1">khi bé giao đến tận tay của chủ thì mới nhận tiền.</p>
                                                    <input type="hidden" name="phuong_thuc_thanh_toan_id" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Đặt đơn</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
