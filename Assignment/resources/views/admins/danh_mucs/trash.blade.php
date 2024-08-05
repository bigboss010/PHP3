@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <style>
        th{
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

        {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a> --}}
    </div>
    @if (session('errors'))
        <div class="text-center alert alert-danger mb-3">
            <span style="color: red">{{ session('errors') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="text-center alert alert-success mb-3">
            <span style="color: green">{{ session('success') }}</span>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($list) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($list as $index => $danhMuc)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url($danhMuc->hinh_anh) }}" width="120" height="125"
                                        alt="{{ $danhMuc->hinh_anh }}">
                                </td>
                                <td>{{ $danhMuc->ten_danh_muc }}</td>
                                <td>{{ $danhMuc->mo_ta }}</td>

                                <td>
                                    <form action="{{ route('admin.danh-mucs.restore', $danhMuc->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $danhMuc->id }}">
                                        <button type="submit" class="btn btn-success btn-icon-split" onclick="return confirm('Bạn có chắc chắn muốn khôi phục không?!??')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-undo"></i>
                                            </span>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.danh-muc.destroy', $danhMuc->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$list->links("pagination::bootstrap-5")}}
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có khách hàng nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
            <a href="{{ route('admin.danh-muc.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
        </div>
    </div>

@endsection
