@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Thông tin cá nhân</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class=" text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <br>
    <h1 class="text-center">Thông tin cá nhân</h1>
    <div class="site-section">
        <div class="container">
            <div class="row">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-name">Họ và tên</th>
                                    <th class="product-name">Email</th>
                                    <th class="product-name">Số điện thoại</th>
                                    <th class="product-name">Địa chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="h5 text-black">{{ Auth::user()->name }}</td>
                                    <td class="h5 text-black">{{ Auth::user()->email }}</td>
                                    <td class="h5 text-black">{{ Auth::user()->phoneNumber == null ? 'Chưa cập nhật' : Auth::user()->phoneNumber }}</td>
                                    <td class="h5 text-black">{{ Auth::user()->address == null ? 'Chưa cập nhật' : Auth::user()->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>            
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <a href="{{route('/.profileEdit', Auth::user()->id)}}" class="btn btn-warning">Cập nhật thông tin</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-secondary">Đổi mật khẩu</a>
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection

@yield('scripts')
