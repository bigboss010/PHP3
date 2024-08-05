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
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Họ và tên</th>
                            <th class="product-name">Email</th>
                            <th class="product-name">Số điện thoại</th>
                            <th class="product-name">Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td class="product-thumbnail">
                                    <img src="{{ Storage::url($details['image']) }}" alt="Image" class="img-fluid">
                                </td> --}}
                            <td>
                                <h2 class="h5 text-black">{{ Auth::user()->name }}</h2>
                            </td>
                            <td class="h5 text-black">{{ Auth::user()->email }}</td>
                            <td class="h5 text-black">
                                {{ Auth::user()->phoneNumber == null ? 'Chưa cập nhật' : Auth::user()->phoneNumber }}
                            </td>
                            <td class="h5 text-black">
                                {{ Auth::user()->address == null ? 'Chưa cập nhật' : Auth::user()->address == null }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <a href="#" class="btn btn-warning">Cập nhật thông tin</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-secondary">Đổi mật khẩu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
