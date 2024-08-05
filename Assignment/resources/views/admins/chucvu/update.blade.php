@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm align-items-center justify-content-between mb-5">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
   
  

    <form action="{{route('admin.chuc_vus.update', $list->id)}}"  method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @method('put')
        @csrf

        <div class="form-group" >
            <label for="ten_chuc_vu">Tên Chức vụ:</label>
            <input type="text" class="form-control" id="ten_chuc_vu" value="{{$list->ten_chuc_vu}}" name="ten_chuc_vu">
        </div>
        <br>
        <input class="btn btn-outline-warning mr-2" type="submit" value="Sửa">

        <a href="{{ route('admin.chuc_vus.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
</div>
@endsection
