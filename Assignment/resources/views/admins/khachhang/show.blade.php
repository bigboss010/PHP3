@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <style>
        th{
            text-align: center;
        }
    </style>
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
             
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tên: {{ $list->name }}</h5>
                        <p class="card-text">Email: {{ $list->email }}</p>
                        <p class="card-text">Xác thực email: {{ $list->email_verified_at }}</p>
                        <p class="card-text">Chức vụ: {{ $list->ten_chuc_vu }}</p>
                
                        <a href="{{ route('admin.users.index') }}" class="btn btn-success">Danh sách</a>
                       
                    </div>
                </div>
                
              
            </div>
        </div>
    </div>

@endsection
