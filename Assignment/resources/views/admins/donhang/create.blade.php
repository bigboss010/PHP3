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
  

    <form action="{{route('admin.don_hangs.store')}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        
        

        <div class="form-group" >
            <label for="ma_don_hang">Mã Đơn Hàng:</label>
            <input type="text" class="form-control" id="ma_don_hang" name="ma_don_hang">
        </div>
        <br>
       
        <div class="form-group" >
            <label for="user_id">Tài khoản::</label>
            <select name="user_id" class="form-control" id="user_id">
                <option value="">Mời chọn</option>
                @foreach ($khachHangs as $value)  
                    <option value="{{ $value->id }}" >{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="form-group" >
            <label for="ten_nguoi_nhan">Tên Người nhận:</label>
            <input type="text" class="form-control" id="ten_nguoi_nhan" name="ten_nguoi_nhan">
        </div>
        <br>
        <div class="form-group" >
            <label for="email_nguoi_nhan">Email Người nhận:</label>
            <input type="email" class="form-control" id="email_nguoi_nhan" name="email_nguoi_nhan">
        </div>
        <br>
        <div class="form-group" >
            <label for="so_dien_thoai_nguoi_nhan">Số điện thoại:</label>
            <input type="text" class="form-control" id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan">
        </div>
        <br>
        <div class="form-group" >
            <label for="dia_chi_nguoi_nhan">Địa chỉ:</label>
            <input type="text" class="form-control" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan">
        </div>
        <br>

        <div class="form-group" >
            <label for="ngay_dat">Ngày đặt:</label>
            <input type="date" class="form-control" id="ngay_dat" name="ngay_dat">
        </div>
        <br>
        <div class="form-group" >
            <label for="tong_tien">Tổng tiền:</label>
            <input type="number" class="form-control" id="tong_tien" name="tong_tien">
        </div>
        <br>
        <div class="form-group" >
            <label for="ghi_chu">Ghi chú:</label>
            <input type="text" class="form-control" id="ghi_chu" name="ghi_chu">
        </div>
        <br>
        
        <div class="form-group" >
            <label for="name">Phương thức thanh toán:</label>
            <select name="phuong_thuc_thanh_toan_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($listPTDH as $value)  
                    <option value="{{ $value->id }}" >{{ $value->ten_phuong_thuc }}</option>
                @endforeach
            </select>
        </div>
        <br> 

         <div class="form-group" >
            <label for="name">Trạng thái:</label>
            <select name="trang_thai_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($listTT as $value)  
                    <option value="{{ $value->id }}" >{{ $value->ten_trang_thai }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <input class="btn btn-outline-success mr-2" type="submit" value="Thêm mới">

        <a href="{{ route('admin.don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
