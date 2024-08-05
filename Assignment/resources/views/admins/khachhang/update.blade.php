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
    <div class="card shadow mb-4">
        <div class="card-body">

    <form action="{{route('admin.users.update', $list->id)}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @method('put')
        @csrf
        
        <div class="form-group" >
            <label for="name">Chức vụ:</label>
            <select name="chuc_vu_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($listCV as $value)  
                    <option {{ $list->chuc_vu_id == $value->id ? 'selected' : '' }} value="{{$value->id}}" >
                        {{ $value->ten_chuc_vu }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="form-group" >
            <label for="name">Tên tài khoản:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$list->name}}">
        </div>
        <br>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$list->email}}">
        </div>
        <br>

        <div class="form-group">
            <label for="email_verified_at">Xác thực email:</label>
            <input type="date" class="form-control" id="email_verified_at" name="email_verified_at" value="{{$list->email_verified_at}}">
        </div>
        <br>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" value="{{$list->password}}"> 
        </div>
        <br>
     
        <input class="btn btn-outline-warning mr-2" type="submit" value="Sửa">

        <a href="{{ route('admin.users.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
        </div>
    </div>
@endsection
