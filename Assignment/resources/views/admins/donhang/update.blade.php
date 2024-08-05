@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm align-items-center justify-content-between mb-5">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>
  

    <form action="{{route('admin.don_hangs.update', $list->id)}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        @method('put')
        

        {{-- <div class="form-group" >
            <label for="ma_don_hang">Mã Đơn Hàng:</label>
            <input type="text" class="form-control" id="ma_don_hang" name="ma_don_hang" value="{{$list->ma_don_hang}}">
        </div>
        <br> --}}
       
        {{-- <div class="form-group" >
            <label for="name">ID tài khoản::</label>
            <select name="tai_khoan_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($khachHangs as $item)
                <option {{ $list->tai_khoan_id == $item->id ? 'selected' : '' }} value="{{ $list->id }}">
                   {{ $item->id }}</option>
            @endforeach
            </select>
        </div>
        <br> --}}

        {{-- <div class="form-group" >
            <label for="ten_nguoi_nhan">Tên Người nhận:</label>
            <input type="text" class="form-control" id="ten_nguoi_nhan" name="ten_nguoi_nhan" value="{{$list->ten_nguoi_nhan}}">
        </div>
        <br>
        <div class="form-group" >
            <label for="email_nguoi_nhan">Email Người nhận:</label>
            <input type="email" class="form-control" id="email_nguoi_nhan" name="email_nguoi_nhan" value="{{$list->email_nguoi_nhan}}">
        </div>
        <br>
        <div class="form-group" >
            <label for="so_dien_thoai_nguoi_nhan">Số điện thoại:</label>
            <input type="number" class="form-control" id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan" value="{{$list->so_dien_thoai_nguoi_nhan}}">
        </div>
        <br>
        <div class="form-group" >
            <label for="dia_chi_nguoi_nhan">Địa chỉ:</label>
            <input type="text" class="form-control" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" value="{{$list->dia_chi_nguoi_nhan}}">
        </div>
        <br>

        <div class="form-group" >
            <label for="ngay_dat">Ngày đặt:</label>
            <input type="date" class="form-control" id="ngay_dat" name="ngay_dat" 
            value="{{ (new DateTime($list->ngay_dat))->format('Y-m-d') }}">
        </div>
        <br>
        <div class="form-group" >
            <label for="tong_tien">Tổng tiền:</label>
            <input type="number" class="form-control" id="tong_tien" name="tong_tien" value="{{$list->tong_tien}}">
        </div>
        <br>
        <div class="form-group" >
            <label for="ghi_chu">Ghi chú:</label>
            <input type="text" class="form-control" id="ghi_chu" name="ghi_chu" value="{{$list->ghi_chu}}">
        </div>
        <br>
         --}}
        {{-- <div class="form-group" >
            <label for="name">Phương thức thanh toán:</label>
            <select name="phuong_thuc_thanh_toan_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($PhuongThucThanhToans as $item)
                <option {{ $list->phuong_thuc_thanh_toan_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                    {{ $item->ten_phuong_thuc }}</option>
                    @endforeach
            </select>
        </div>
        <br>  --}}

         <div class="form-group" >
            <label for="name">Trạng thái:</label>
            <select name="trang_thai_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($TrangThaiDonHangs as $item)
                <option {{ $list->trang_thai_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                    {{ $item->ten_trang_thai }}</option>
                    @endforeach
            </select>
        </div>
        <br>

        <input class="btn btn-outline-warning mr-2" type="submit" value="Sửa">

        <a href="{{ route('admin.don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
