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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.binh-luan.store') }}" method="POST" class="m-3">
                @csrf
                <div class="form-group">
                    <label for="user_id">Tên tài khoản:</label>
                    <select name="user_id" class="form-control form-select" id="user_id">
                        <option selected>-- Vui lòng chọn tên tài khoản --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($pets as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="noi_dung">Nội dung:</label>
                    <textarea class="form-control" name="noi_dung" id="noi_dung" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="thoi_gian">Thời gian:</label>
                    <input type="date" class="form-control" id="thoi_gian" name="thoi_gian">
                </div>
                <div class="mb-2 ps-3 d-flex justify-content-between">
                    <label for="trang_thai" class="form-lable">Trạng thái:</label>
                    <div class="col-sm-10 mb-3 d-flex gap-2">
                        <div class="form-check mr-3">
                            <input type="radio" class="form-check-input" id="trang_thai" value="1" name="trang_thai"
                                checked>
                            <label for="trang_thai" class="form-check-lable">
                                Hiển thị
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="trang_thai" value="0" name="trang_thai">
                            <label for="trang_thai" class="form-check-lable">
                                Ẩn
                            </label>
                        </div>
                    </div>
                    @error('trang_thai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Thêm mới</button>

                <a href="{{ route('admin.binh-luan.index') }}"><button type="button" class="btn btn-info">Danh
                        sách</button></a>
            </form>
        </div>
    </div>
@endsection
