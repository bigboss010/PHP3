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
  

    <form action="{{route('admin.users.store')}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        
        <div class="form-group" >
            <label for="name">Chức vụ:</label>
            <select name="chuc_vu_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($list as $index=>$value)  
                    <option value="{{ $value->id }}" >{{ $value->ten_chuc_vu }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="form-group" >
            <label for="name">Tên tài khoản:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <br>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <br>

        <div class="form-group">
            <label for="email_verified_at">Xác thực email:</label>
            <input type="date" class="form-control" id="email_verified_at" name="email_verified_at">
        </div>
        <br>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <br>
       
        <input class="btn btn-outline-success mr-2" type="submit" value="Thêm mới">

        <a href="{{ route('admin.users.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
