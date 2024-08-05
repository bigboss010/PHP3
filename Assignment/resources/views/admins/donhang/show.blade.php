@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <style>
        th{
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>
    @if (session('errors'))
        <div class="text-center alert alert-danger mb-3">
            <span style="color: red">{{ session('errors') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="text-center alert alert-success mb-3">
            <span style="color: green">{{ session('success') }}</span>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
             
                
                {{-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mã đơn hàng: {{ $order->ma_don_hang }}</h5>
                        <p class="card-text">Id người dùng: {{ $order->khachHang->name }}</p>
                        <p class="card-text">Tên người nhận: {{ $order->ten_nguoi_nhan }}</p>
                        <p class="card-text">Email người nhận: {{ $order->email_nguoi_nhan }}</p>
                        <p class="card-text">Số điện thoại: {{ $order->so_dien_thoai_nguoi_nhan }}</p>
                        <p class="card-text">Địa chỉ: {{ $order->dia_chi_nguoi_nhan }}</p>
                        <p class="card-text">Ngày đặt: {{ $order->ngay_dat }}</p>
                        <p class="card-text">Tổng tiền: {{ $order->tong_tien }}</p>
                        <p class="card-text">Ghi chú: {{ $order->ghi_chu }}</p>
                        <p class="card-text">Phương thức thanh toán: {{ $order->phuongThucThanhToan->ten_phuong_thuc }}</p>
                        <p class="card-text">Trạng thái: {{ $order->trangThai->ten_trang_thai }}</p>
                    </div>
                    <a href="{{ route('admin.don_hangs.index') }}" class="btn btn-success">Danh sách</a>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mã đơn hàng: {{ $order->ma_don_hang }}</h5>
                        <p class="card-text">Id người dùng: {{ optional($order->khachHang)->name }}</p>
                        <p class="card-text">Tên người nhận: {{ $order->ten_nguoi_nhan }}</p>
                        <p class="card-text">Email người nhận: {{ $order->email_nguoi_nhan }}</p>
                        <p class="card-text">Số điện thoại: {{ $order->so_dien_thoai_nguoi_nhan }}</p>
                        <p class="card-text">Địa chỉ: {{ $order->dia_chi_nguoi_nhan }}</p>
                        <p class="card-text">Ngày đặt: {{ $order->ngay_dat }}</p>
                        <p class="card-text">Tổng tiền: {{ $order->tong_tien }}</p>
                        <p class="card-text">Ghi chú: {{ $order->ghi_chu }}</p>
                        <p class="card-text">Phương thức thanh toán: {{ optional($order->phuongThucThanhToan)->ten_phuong_thuc }}</p>
                        <p class="card-text">Trạng thái: {{ optional($order->trangThai)->ten_trang_thai }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
