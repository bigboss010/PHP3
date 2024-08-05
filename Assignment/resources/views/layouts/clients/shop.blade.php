@extends('layouts.clients.master')


@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cửa hàng</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-9 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Cửa hàng</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Mới nhất
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuReference" data-toggle="dropdown">Sắp xếp</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="#">Tên, A to Z</a>
                                        <a class="dropdown-item" href="#">Tên, Z to A</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Giá, thấp đến cao</a>
                                        <a class="dropdown-item" href="#">Giá, cao đến thấp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        @if (count($list) > 0)
                            @foreach ($list->take(9) as $item)
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="block-4 text-center border product-card">
                                        <div class="block-4-image">
                                            <img src="{{ Storage::url($item->image) }}" alt="Image placeholder"
                                                class="img-fluid additional-image w-100">
                                        </div>
                                        <div class="block-4-text p-4">
                                            <h3 class="text-truncate">
                                                <a href="{{ route('/.shop-single', $item->id) }}">{{ $item->ten_pet }}</a>
                                            </h3>
                                            <p class="mb-0 text-truncate">{{ $item->mota }}</p>
                                            <p class="text-primary font-weight-bold">
                                                {{ number_format($item->gia_pet, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="col-lg-12 text-center">Không có thú cưng nào!</h3>
                        @endif
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Danh mục</h3>
                        <ul class="list-unstyled mb-0">
                            @foreach ($danhMucs as $item)
                                <li class="mb-1"><a href="{{ route('/.shopDanhMuc', $item->id) }}"
                                        class="d-flex"><span>{{ $item->ten_danh_muc }}</span> <span
                                            class="text-black ml-auto"></span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="border p-4 rounded mb-1">
                        <div class="mt-4">
                            <h3 class="mb-1 h6 text-uppercase text-black d-block">Tìm kiếm theo giá</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                                disabled="" />
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.clients.components.categories', ['danhMucs' => $danhMucs])
        </div>
    </div>
@endsection
