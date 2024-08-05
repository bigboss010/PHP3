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
            <form action="{{ route('admin.binh-luan.update', $binhLuan ->id) }}" method="POST" class="m-3">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="user_id">Tên tài khoản:</label>
                    <select name="user_id" class="form-control form-select" id="user_id">
                        <option selected>-- Vui lòng chọn tên tài khoản --</option>
                        @foreach ($users as $item)
                            <option {{ ($binhLuan->user_id == $item->id) ? 'selected' : ""}} 
                            value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($pets as $item)
                            <option {{ ($binhLuan->pet_id == $item->id) ? 'selected' : ""}} 
                            value="{{ $item->id }}">{{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="noi_dung">Nội dung:</label>
                    <textarea class="form-control" name="noi_dung" id="noi_dung" cols="30" rows="3">{{ $binhLuan->noi_dung }}</textarea>
                </div>
                <div class="form-group">
                    <label for="thoi_gian">Thời gian:</label>
                    <input type="date" class="form-control" id="thoi_gian" name="thoi_gian" value="{{ (new \DateTime($binhLuan->thoi_gian))->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="trang_thai">Trạng thái:</label>
                    <input type="text" class="form-control" id="trang_thai" name="trang_thai" value="{{ $binhLuan->trang_thai }}">
                </div>


                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('admin.binh-luan.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
