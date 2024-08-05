@extends('admins.layouts.default')

@section('title')
    {{ $title }}
@endsection

@section('css')
   
@endsection

@section('content')
    <div class="p-4" style="min-height: 800px;">
        <h1 class="text-center mb-4">{{ $title }}</h1>
        <form action="{{ route('admin.products.addPostProduct') }}" method="POST" enctype="multipart/form-data">
            {{-- @csrf: dùng để xác minh form này không phải từ nơi khác, tránh bị tấn công --}}
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm:</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea  class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="form-control btn btn-primary">Thêm mới</button><br><br>
            <a href="{{ route('admin.products.listProducts')}}" class="form-control btn btn btn-success">Danh sách</a>
        </form>
    </div>
@endsection

@section('js')
    
@endsection

