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
                            <th>Họ và tên</th>
                            <th>Tên pet</th>
                            <th>Nội dung</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            {{-- <th>Created_at</th>
                            <th>Updated_at</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Họ và tên</th>
                            <th>Tên pet</th>
                            <th>Nội dung</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            {{-- <th>Created_at</th>
                            <th>Updated_at</th> --}}
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($list as $index => $binhLuan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $binhLuan->name }}</td>
                                <td>{{ $binhLuan->ten_pet }}</td>
                                <td>{{ $binhLuan->noi_dung }}</td>
                                <td>{{ (new DateTime($binhLuan->thoi_gian))->format('d/m/Y H:i:s') }}</td>
                                <td class="{{ ($binhLuan->trang_thai == 1) ? 'text-success' : 'text-danger'}}">{{ $binhLuan->trang_thai == 1 ? "Hiển thị" : "Ẩn" }}</td>
                                {{-- <td>{{ (new DateTime($binhLuan->created_at))->format('d/m/Y H:i:s') }}</td>
                                <td>{{ (new DateTime($binhLuan->updated_at))->format('d/m/Y H:i:s') }}</td> --}}

                                <td>
                                    <form action="{{ route('admin.binh-luans.restore', $binhLuan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $binhLuan->id }}">
                                        <button type="submit" class="btn btn-success btn-icon-split" onclick="return confirm('Bạn có chắc chắn muốn khôi phục không?!??')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-undo"></i>
                                            </span>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.binh-luan.destroy', $binhLuan->id) }}" method="POST"
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
                        <p>Không có bình luận nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
            <a href="{{ route('admin.binh-luan.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
        </div>
    </div>

@endsection
