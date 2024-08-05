@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

        <a href="{{ route('admin.don_hangs.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
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
                                <th>Mã đơn hàng</th>
                                {{-- <th>ID tài khoản</th> --}}
                                <th>Tên người nhận</th>
                                {{-- <th>Email người nhận</th> --}}
                                {{-- <th>Số điện thoại</th> --}}
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                {{-- <th>Tổng tiền</th>
                                <th>Ghi chú</th> --}}
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                {{-- <th>ID tài khoản</th> --}}
                                <th>Tên người nhận</th>
                                {{-- <th>Email người nhận</th> --}}
                                {{-- <th>Số điện thoại</th> --}}
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                {{-- <th>Tổng tiền</th>
                                <th>Ghi chú</th> --}}
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($list as $index => $value)
                                <tr>
                                    <td>{{ $index + 1 }} </td>
                                    <td>{{ $value->ma_don_hang }} </td>
                                    {{-- <td>{{ $value->user_id }} </td> --}}
                                    <td>{{ $value->ten_nguoi_nhan }} </td>
                                    {{-- <td>{{ $value->email_nguoi_nhan }} </td>
                                    <td>{{ $value->so_dien_thoai_nguoi_nhan }} </td> --}}
                                    <td>{{ $value->dia_chi_nguoi_nhan }} </td>
                                    <td>{{ (new DateTime($value->ngay_dat))->format('d-m-y') }} </td>
                                    {{-- <td>{{ $value->tong_tien }} </td>
                                    <td>{{ $value->ghi_chu }} </td> --}}
                                    <td>{{ $value->ten_phuong_thuc }} </td>
                                    <td>{{ $value->ten_trang_thai }} </td>



                                    <td>
                                        <form action="{{ route('admin.donhang.restore', $value->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            <button type="submit" class="btn btn-success btn-icon-split" onclick="return confirm('Bạn có chắc chắn muốn khôi phục không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-undo"></i>
                                                </span>
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('admin.khachhang.delete') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$value->id }}">
                                            <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form> --}}

                                        <form action="{{ route('admin.don_hangs.destroy', $value->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split"
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
                        <p>Không có đơn hàng nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
            <a href="{{ route('admin.don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
        </div>
    </div>
@endsection
