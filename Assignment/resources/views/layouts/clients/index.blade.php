@extends('layouts.clients.master')


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .carousel-item {
        height: 500px; /* Set a fixed height for the carousel */
    }
    .carousel-item .image-container {
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
</style>


@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($sliders as $key => $image)
        <div class="carousel-item @if($key == 0) active @endif">
            <img src="{{ Storage::url($image->hinh_anh) }}" class="d-block w-100" alt="Slider Image">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-truck"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Miễn phí vận chuyển</h2>
                        <p>Chúng tôi miễn phí vận chuyển cho khách hàng tại khu vực Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-refresh2"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Hoàn trả nhanh chóng</h2>
                        <p>Chúng tôi có chính sách hoàn trả cho những bé mà được giao nhầm với khách hàng</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-help"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Hỗ trợ khách hàng</h2>
                        <p>Chính sách hỗ trợ khách hàng tiện lợi, cộng tác viên trên shop hoạt động 24/24</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.clients.components.categories', ['danhMucs' => $danhMucs])

    @include('layouts.clients.components.featured-product', ( $list) ? (['list' => $list]) : '') {{-- ,'count' => 10 --}}

    <div class="site-section block-8">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Đại giảm giá!</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <a href="#"><img src="{{ asset('assets/client/images/sale') }}.jpg" alt="Image placeholder"
                            class="img-fluid rounded"></a>
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h2><a href="#">50% các bé có trên shop</a></h2>

                    <p>Sự kiện này sẽ bắt đầu vào đầu tháng 9 nhớ ghé thăm để nhận siêu ưu đãi cực khủng này !!!</p>
                    <p><a href="{{ route('/.shop') }}" class="btn btn-primary btn-sm">Shop Now</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection


