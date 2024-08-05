@extends('layouts.clients.master')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('/.index') }}">Trang chủ</a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Chi tiết đơn hàng</strong>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1 class="text-black">Chi tiết đơn hàng</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Thông tin khách hàng</h4>
            <p>
                Tên khách hàng: {{ $donHangDetail->ten_nguoi_nhan }}<br>
                Địa chỉ: {{ $donHangDetail->dia_chi_nguoi_nhan }}<br>
                Điện thoại: {{ $donHangDetail->so_dien_thoai_nguoi_nhan }}<br>
                Email: {{ $donHangDetail->email_nguoi_nhan }}<br>
            </p>
        </div>
        <div class="col-md-6 text-left">
            <h4>Thông tin hóa đơn</h4>
            <p>
                Mã đơn hàng: {{ $donHangDetail->ma_don_hang }}<br>
                Ngày đặt: {{ (New DateTime($donHangDetail->ngay_dat))->format('d/m/Y') }}<br>
                Trạng thái đơn hàng: {{ $trangThaiDH[$donHangDetail->trang_thai_id] }}<br>
                Trạng thái thanh toán: {{ $trangThaiTT[$donHangDetail->phuong_thuc_thanh_toan_id] }}<br>
            </p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="site-blocks-table">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Mã thú cưng</th>
                            <th>Tên thú cưng</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donHangDetail->chiTietDonHang as $item)
                        @php
                            $pets = $item->pet;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ Storage::url($pets->image) }}" width="75" height="80"
                                            alt="{{ $pets->image }}">
                            </td>
                            <td>{{ $pets->ma_pet }}</td>
                            <td>{{ $pets->ten_pet }}</td>
                            <td>{{ number_format($item->gia, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $item->so_luong}}</td>
                            <td>{{ number_format($item->thanh_tien, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-right">
            {{-- <h4>Tổng cộng: {{ $orderTotal }}</h4> --}}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection
