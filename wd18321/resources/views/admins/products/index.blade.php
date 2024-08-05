@extends('admins.layouts.default')

@section('title')
    {{ $title }}
@endsection

@push('css')
    
@endpush

@section('content')
    <div class="p-4" style="min-height: 800px;">
        {{-- @if ($check)
            <a href="{{ route('product.index') }}" class="btn btn-success">Danh sách</a>
        @endif --}}
        <a href="{{ route('admin.products.addProduct')}}" class="btn btn-primary">Thêm mới</a>
        {{-- <form action="" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="text-center">
                <input type="text" class="border border-primary rounded-start" id="name" name="key"
                    placeholder="Tìm kiếm...">
                <input type="submit" class="btn btn-primary" name="search" id="" value="Tìm kiếm">
            </div>
        </form> --}}
        <br><br>
        @if (session('success'))
            <div class="text-center alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('errors'))
            <div class="text-center alert alert-danger">{{ session('errors') }}</div>
        @endif
        <h1 class="text-center mb-4">{{ $title }}</h1>
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>                   
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listProduct as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{-- <td><img src="{{ Storage::url($product->image) }}" width="120" alt="Ảnh sản phẩm"></td> --}}
                        <td><img src="{{ asset($product->image) }}" width="120" alt="Ảnh sản phẩm"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
        
                        <td>
                            <a href="{{ route('admin.products.detailProduct', $product->product_id)}}" class="btn btn-warning">Sửa</a>
                            <br><br>
                            <a href="{{ route('admin.products.delProduct', $product->product_id)}}"
                                onclick="return confirm('Bạn có chắc chắn xóa không?')" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $listProduct->links('pagination::bootstrap-5')}}
    </div>
@endsection

@push('js')
    
@endpush
