@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Chỉnh sửa thông tin cá nhân</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1 class="text-center my-5">Chỉnh sửa thông tin cá nhân</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="{{route('admin.users.update', Auth::user()->id)}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên tài khoản:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">SĐT:</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{Auth::user()->phoneNumber}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{Auth::user()->address}}">
                        </div>
                        <div class="form-group text-center">
                            <input class="btn btn-outline-warning mr-2" type="submit" value="Sửa">
                            <a href="{{ route('/.profile') }}" class="btn btn-info">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@yield('scripts')
