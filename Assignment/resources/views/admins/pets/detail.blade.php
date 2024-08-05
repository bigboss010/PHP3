@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th class="text-center" colspan="2">
                                <h2>PET</h2>
                            </th>
                        </tr>
                        <tr>
                            <th>Mã pet</th>
                            <td>{{ $pets->ma_pet }}</td>
                        </tr>
                        <tr>
                            <th>Tên pet</th>
                            <td>{{ $pets->ten_pet }}</td>
                        </tr>
                        <tr>
                            <th>Ảnh pet</th>
                            <td class="">
                                <img src="{{ Storage::url($pets->image) }}" width="120" height="125"
                                    alt="{{ $pets->image }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Danh mục</th>
                            <td>{{ $pets->ten_danh_muc }}</td>
                        </tr>
                        <tr>
                            <th>Giá gốc</th>
                            <td>{{ number_format($pets->gia_pet) }}</td>
                        </tr>
                        <tr>
                            <th>Giá khuyến mại</th>
                            <td>{{ empty($pets->gia_khuyen_mai) ? 0 : number_format($pets->gia_khuyen_mai) }}</td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td>{{ $pets->so_luong }}</td>
                        </tr>
                        <tr>
                            <th>Ngày nhập</th>
                            <td>{{ (new DateTime($pets->ngay_nhap))->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả ngắn</th>
                            <td>{{ $pets->mota }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả chi tiết</th>
                            <td>{!! $pets->mo_ta_chi_tiet !!}</td>
                        </tr>
                        <tr>
                            <th>Trang thái</th>
                            <td class="{{ $pets->trang_thai == 1 ? 'text-success' : 'text-danger' }}">
                                {{ $pets->trang_thai == 1 ? 'Hiện' : 'Ẩn' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Lượt xem</th>
                            <td>{{ $pets->luot_xem }}</td>
                        </tr>
                        <tr>
                            <th>Is_New</th>
                            <td>{{ $pets->is_new }}</td>
                        </tr>
                        <tr>
                            <th>Is_Hot</th>
                            <td>{{ $pets->is_hot }}</td>
                        </tr>
                        <tr>
                            <th>Is_Home</th>
                            <td>{{ $pets->is_home }}</td>
                        </tr>
                        <tr>
                            <th>Created_at</th>
                            <td>{{ $pets->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Is_Home</th>
                            <td>{{ $pets->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th class="text-center" colspan="2">
                                <h2>List Ảnh</h2>
                            </th>
                        </tr>
                        @foreach ($imagePet as $item)
                            <tr>
                                <th>{{'Ảnh pet' . ' ' . $item->pet_id}}</th>
                                <td class="">
                                    <img src="{{ Storage::url($item->link_anh) }}" width="120" height="125"
                                        alt="{{ $item->link_anh }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('admin.pet.index') }}"><button type="button" class="btn btn-info">Danh
                        sách</button></a>
            </div>
        </div>
    </div>
@endsection
