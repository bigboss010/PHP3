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
  

    <form action="{{route('admin.chi_tiet_don_hangs.store')}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        <div class="form-group" >
            <label for="gio_hang_id">Giỏ hàng:</label>
            <select name="gio_hang_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($listGH as $index=>$value)  
                    <option value="{{ $value->id }}" >{{ $value->name }} </option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group" >
            <label for="pet_id ">Cún:</label>
            <select name="pet_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($listP as $index=>$value)  
                    <option value="{{ $value->id }}" >{{ $value->ten_pet }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group" >
            <label for="gia">Giá:</label>
            <input type="number" class="form-control" id="gia" name="gia">
        </div>
        <br>
        <div class="form-group" >
            <label for="so_luong">Số lượng:</label>
            <input type="number" class="form-control" id="so_luong" name="so_luong">
        </div>
        <br>

        <input class="btn btn-outline-success mr-2" type="submit" value="Thêm mới">

        <a href="{{ route('admin.chi_tiet_don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
