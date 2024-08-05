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
            <a href="{{ route('admin.don_hangs.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
            <a href="{{ url('admins/donhang/trash') }}" class="btn btn-secondary btn-icon-split">
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
                @if (count($list) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($list as $index => $value)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $value->ma_don_hang }} </td>
                                    <td>{{ (new DateTime($value->ngay_dat))->format('d-m-y') }} </td>
                                    <td>{{ $trangThaiTT[$value->phuong_thuc_thanh_toan_id] }} </td>
                                    <td>
                                        <form action="{{ route('admin.don_hangs.update', $value->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select onchange="confirmSubmit(this)" data-default-value="{{ $value->trang_thai_id }}" 
                                            name="trang_thai_id" class="form-control" id="">
                                                @foreach ($trangThaiDH as $key => $item)
                                                    <option {{ $key == $value->trang_thai_id ? 'selected' : '' }}
                                                        {{ $key == '6' ? 'disabled' : '' }}
                                                        value="{{ $key }}">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.don_hangs.show', $value->id) }}" class="btn btn-primary">
                                            <span class="icon text-white-50">
                                                <i class="far fa-eye"></i>
                                            </span>
                                        </a>
                                        {{-- <a href="{{ route('admin.don_hangs.edit', $value->id) }}" class="btn btn-warning">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>

                                        </a> --}}
                                        @if ($value->trang_thai_id == '6')
                                            <form action="{{ route('admin.donhang.delete') }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form>
                                        @endif

                                        {{-- <form action="{{ route('admin.don_hangs.destroy', $value->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Xóa</span>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $list->links('pagination::bootstrap-5') }}
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có đơn hàng nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if(confirm('Bạn có chắc chắn thay đổi trang thái đơn hàng thành "'+ selectedOption +'" không?')) {
                form.submit();
            }else{
                selectElement.value = defaultValue;
            }
        }
    </script>
@endsection
