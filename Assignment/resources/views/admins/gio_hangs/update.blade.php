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
            <form action="{{ route('admin.gio-hang.update', $gioHang->id) }}" method="POST" class="m-3">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="user_id">Tên tài khoản:</label>
                    <select name="user_id" class="form-control form-select" id="user_id">
                        <option selected>-- Vui lòng chọn tên tài khoản --</option>
                        @foreach ($users as $item)
                            <option {{ ($gioHang->user_id == $item->id) ? 'selected' : ""}} 
                            value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('admin.gio-hang.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
