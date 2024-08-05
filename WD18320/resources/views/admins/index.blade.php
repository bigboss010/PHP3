@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <style>
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">Danh sách sản phẩm</h1>
            <p class="mb-4">
                Sản phẩm
                <a target="_blank" href="https://datatables.net">Admin</a>.
            </p>
            <a href="{{ route('san-pham.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
        </div>

        <div class="d-flex justify-content-between">
           
            <form action="{{ route('san-pham.index')}}" method="GET">
                <div class="input-group">
                    <select name="searchTrangThai" class="form-select" id="">
                        <option value="" selected>-- Chọn trạng thái --</option>
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                    <input type="text" name="search" class="form-control"
                    value="{{ request('search')}}" placeholder="Tìm kiếm...">
                    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                </div>
            </form>

        </div>
    </div>
    @if (session('errors'))
        <div class="text-center alert alert-danger mb-3">
            <span>{{ session('errors') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="text-center alert alert-success mb-3">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($listSanPhams) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Ngày nhập</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Ngày nhập</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($listSanPhams as $index => $listSanPham)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ Storage::url($listSanPham->hinh_anh) }}" width="120"
                                            alt="{{ $listSanPham->hinh_anh }}"></td>
                                    <td>{{ $listSanPham->ma_san_pham }}</td>
                                    <td>{{ $listSanPham->ten_san_pham }}</td>
                                    <td>{{ $listSanPham->gia }}</td>
                                    <td>{{ $listSanPham->so_luong }}</td>
                                    <td>{{ $listSanPham->ngay_nhap }}</td>
                                    <td>{{ $listSanPham->mota }}</td>
                                    <td>{{ $listSanPham->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>

                                    <td>
                                        <a href="{{ route('san-pham.edit', $listSanPham->id) }}"
                                            class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Sửa</span>
                                        </a>
                                        <br><hr>
                                        <form action="{{ route('san-pham.destroy', $listSanPham->id) }}" method="POST" 
                                            onsubmit="return confirm('Bạn có chắc chắn xóa không?')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Xóa</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Hiển thị phân trang --}}
                    {{ $listSanPhams->links("pagination::bootstrap-5") }}
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có sản phẩm nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script></script>
@endsection
