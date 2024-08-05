@extends('layouts.admins.master')

@section('content')
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke {
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
        </style>
        <div class="col-auto mb-3">
            <p class="title_thongke">Thống kê đơn hàng doanh thu</p>
        </div>
        <div class="row align-items-center mt-3 justify-content-center">
            <div class="col-md-3">
                Từ ngày: <input type="text" id="datepicker" class="form-control">
            </div>
            <div class="col-md-3">
                Đến ngày: <input type="text" id="datepicker2" class="form-control">
            </div>
            <div class="col-md-3">
                <form autocomplete="off">
                    @csrf
                    Lọc theo quý:
                    <select class="dashboard-filter form-control">
                        <option>---Chọn---</option>
                        <option value="quy1">Quý 1</option>
                        <option value="quy2">Quý 2</option>
                        <option value="quy3">Quý 3</option>
                        <option value="quy4">Quý 4</option>
                        {{-- <option value="365ngayqua">365 ngày qua</option> --}}
                    </select>
                </form>
            </div>
            <div class="col-md-3">
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả" style="margin-top: 24px;">
            </div>
        </div>
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 250px;"></div>
        </div>
    </div>
@endsection
