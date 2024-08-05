@extends('layouts.clients.master')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Đơn hàng</strong>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1 class="text-center mb-4">Đơn hàng</h1>
        <div class="site-section">
            <div class="site-blocks-table">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="product-name">Mã đơn hàng</th>
                            <th class="product-name">Ngày đặt</th>
                            <th class="product-name">Tổng tiền</th>
                            <th class="product-name">Trạng thái</th>
                            <th class="product-name">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($donHangs) > 0)
                            @foreach ($donHangs as $item)
                                <tr>
                                    <td class="h5 text-black">{{ $item->ma_don_hang }}</td>
                                    <td class="h5 text-black">{{ (new DateTime($item->ngay_dat))->format('d/m/Y') }}</td>
                                    <td class="h5 text-black">{{ number_format($item->tong_tien) }} VNĐ</td>
                                    <td class="h5 text-black">{{ $trangThaiDH[$item->trang_thai_id] }}</td>
                                    <td class="h5 text-black">
                                        <a href="{{ route('/.showDetailDonHang', $item->id) }}" class="btn btn-primary">
                                            <i class="far fa-eye"></i>
                                        </a>

                                        <form action="{{ route('/.updateDonHang', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            @if ($item->trang_thai_id == 1)
                                                <input type="hidden" name="huy_don_hang" value="6">
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có muốn hủy đơn hàng không?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @elseif($item->trang_thai_id == 4)
                                                <input type="hidden" name="da_giao_hang" value="5">
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('Xác nhận đã nhận hàng')">
                                                    <i class="far fa-check-circle"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center"><h5>Đơn hàng trống!</h5></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Add any additional scripts here -->
@endsection
