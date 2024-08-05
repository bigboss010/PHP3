@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

         <div class="div">
            <a href="{{ url('admins/binh-luans/trash') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Thùng rác</span>
            </a>
        </div>
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
                @if (count($binhLuans) > 0)
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
                            @foreach ($binhLuans as $index => $binhLuan)
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
                                        {{-- <a href="{{ route('admin.binh-luan.edit', $binhLuan->id) }}"
                                            class="btn btn-warning">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Sửa</span>
                                        </a> --}}

                                        <form action="{{ route('admin.binh-luans.delete') }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$binhLuan->id }}">
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('admin.binh-luan.destroy', $binhLuan->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có bình luận nào được tìm thấy.</p>
                    </div>
                @endif
                {{ $binhLuans->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
@endsection
