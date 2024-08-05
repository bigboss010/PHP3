@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm align-items-center justify-content-between mb-5">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }} - Giỏ hàng {{ $list->gio_hang_id }}</h1>
        </div>
    </div>
  

    <form action="{{route('admin.chi_tiet_don_hangs.update',$list->id)}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        @method('put')
        <div class="form-group" >
            <label for="gio_hang_id">Giỏ hàng:</label>
            <select name="gio_hang_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($gioHangs as $item)  
                    <option {{ $item->id == $list->gio_hang_id ? 'selected' : '' }}  value="{{$item->id}}" > {{ $item->id }}-{{ $item->name }} </option>
                @endforeach
            </select>
        </div>
        <br>

        
        <div class="form-group" >
            <label for="pet_id ">Cún:</label>
            <select name="pet_id" class="form-control" id="">
                <option value="">Mời chọn</option>
                @foreach ($pets as $item)  
                    <option {{ $item->id == $list->pet_id ? 'selected' : '' }}  value="{{$item->id}}" >{{ $item->ten_pet }} </option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group" >
            <label for="gia">Giá:</label>
            <input type="number" class="form-control" id="gia" name="gia" value="{{$list->gia}}">
        </div>
        <br>
        <div class="form-group" >
            <label for="so_luong">Số lượng:</label>
            <input type="number" class="form-control" id="so_luong" name="so_luong" value="{{$list->so_luong}}">
        </div>
        <br>

        <input class="btn btn-outline-warning mr-2" type="submit" value="Sửa">

        <a href="{{ route('admin.chi_tiet_don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
