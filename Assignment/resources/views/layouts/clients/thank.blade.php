@extends('layouts.clients.master')

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
      <span class="icon-check_circle display-3 text-success"></span>
      <h2 class="display-3 text-black">Cảm ơn!</h2>
      <p class="lead mb-5">Đơn hàng đã được đặt hoàn tất.</p>
      <p><a href="{{route('/.shop')}}" class="btn btn-sm btn-primary">quay trở lại cửa hàng</a></p>
    </div>
  </div>
@endsection