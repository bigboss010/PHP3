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
            <form action="{{ route('admin.chi-tiet-gio-hang.update', $gioHangCT->id) }}" method="POST" class="m-3">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="gio_hang_id">Tên tài khoản:</label>
                    <select name="gio_hang_id" class="form-control form-select" id="gio_hang_id">
                        <option selected>-- Vui lòng chọn tên tài khoản --</option>
                        @foreach ($gioHangs as $item)
                            <option {{ ($gioHangCT->gio_hang_id == $item->id) ? 'selected' : ""}} 
                            value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($pets as $item)
                            <option {{ ($gioHangCT->pet_id == $item->id) ? 'selected' : ""}} 
                            value="{{ $item->id }}">{{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="so_luong">Số lượng:</label>
                    <input type="number" class="form-control" min="1" id="so_luong" name="so_luong" value="{{ $gioHangCT->so_luong }}">
                </div>

                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('admin.chi-tiet-gio-hang.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
