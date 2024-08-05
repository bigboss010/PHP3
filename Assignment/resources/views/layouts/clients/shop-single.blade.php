@extends('layouts.clients.master')

<style>
   
</style>

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a> 
                    <span class="mx-2 mb-0">/</span> 
                    <strong class="text-black">{{ $list->ten_pet }}</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ Storage::url($list->image) }}" alt="Image" width="600px" class="img-fluid mb-4">
                     <!-- Additional Images Section -->
                     <div class="row">
                        @foreach($listImage as $image)
                            <div class="col-md-4 mb-2">
                                <img src="{{ Storage::url($image->link_anh) }}" alt="Additional Image" class="img-fluid additional-image h-100">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $list->ten_pet }}</h2>
                    <p>{{ $list->mota }}</p>
                    <p><strong class="text-primary h4">{{ number_format($list->gia_pet, 0, ',', '.') }} VNĐ</strong></p>
                   
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary down" type="button">&minus;</button>
                            </div>
                            <input type="text" id="so_luong" class="form-control text-center" value="1" min="1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary up" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user())
                    <a href="#" id="add-to-cart" class="buy-now btn btn-sm btn-primary">Thêm vào giỏ</a>
                    @else
                    <a href="#" class="buy-now btn btn-sm btn-primary">Vui lòng đăng nhập để đặt hàng!</a>
                    @endif
                    

                </div>
            </div>


            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="p-4 border rounded">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-description-tab" data-toggle="pill"
                                    href="#pills-description" role="tab" aria-controls="pills-description"
                                    aria-selected="true">Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-comments-tab" data-toggle="pill" href="#pills-comments"
                                    role="tab" aria-controls="pills-comments" aria-selected="false">Bình luận</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                aria-labelledby="pills-description-tab">
                                <p>{!! $list->mo_ta_chi_tiet !!}</p>
                            </div>
                            <div class="tab-pane fade" id="pills-comments" role="tabpanel"
                                aria-labelledby="pills-comments-tab">
                                <div id="comments-section">

                                </div>
                                <div id="pagination-links"></div>
                                @if (Auth::user())
                                    <form id="comment-form">
                                        @csrf
                                        <input type="hidden" name="pet_id" class="pet_id" value="{{ $list->id }}">
                                        <input type="hidden" name="user_id" class="user_id" value="{{ Auth::user()->id }}">
                                        <div class="form-group">
                                            <label for="noi_dung">Bình luận:</label>
                                            <textarea class="form-control noi_dung" id="noi_dung" name="noi_dung" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary send-comment">Gửi</button>
                                    </form>
                                @else
                                    <p>Vui lòng đăng nhập để bình luận!</p>
                                @endif
                                <div id="test"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
   
    @include('layouts.clients.components.featured-product', ['list' => $featuredProducts])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Xử lý tăng giảm số lượng
         document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('so_luong');
        const btnMinus = document.querySelector('.down');
        const btnPlus = document.querySelector('.up');

        btnMinus.addEventListener('click', function () {
            let currentValue = parseInt(input.value);
            if (isNaN(currentValue) || currentValue <= 1) {
                input.value = 1;
            } else {
                input.value = currentValue - 1;
            }
        });

        btnPlus.addEventListener('click', function () {
            let currentValue = parseInt(input.value);
            if (isNaN(currentValue)) {
                input.value = 1;
            } else {
                input.value = currentValue + 1;
            }
        });

        input.addEventListener('input', function () {
            let currentValue = parseInt(input.value);
            if (isNaN(currentValue)) {
                alert('Vui lòng nhập một số nguyên hợp lệ lớn hơn 0');
                input.value = 1;
            }
        });

         // Ngăn chặn nhập ký tự không hợp lệ
         input.addEventListener('keypress', function (e) {
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });
    });
        // Thêm vào giỏ hàng
        document.getElementById('add-to-cart').addEventListener('click', function(event) {
            event.preventDefault();
            var soLuong = document.getElementById('so_luong').value;
            var url = "{{ url('/add-to-cart/' . $list->id) }}" + "/" + soLuong;
            window.location.href = url;
        });

        // Bình luận
        $(document).ready(function() {
            load_comment();

            function load_comment(page = 1) {
                var pet_id = $('.pet_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/binh-luan?page=" + page,
                    type: 'POST',
                    data: {
                        pet_id: pet_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comments-section').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", error);
                    }
                });
            }

            $('#comment-form').submit(function(event) {
                event.preventDefault();
                var pet_id = $('.pet_id').val();
                var user_id = $('.user_id').val();
                var noi_dung = $('.noi_dung').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/send-binh-luan",
                    type: 'POST',
                    data: {
                        pet_id: pet_id,
                        user_id: user_id,
                        noi_dung: noi_dung,
                        _token: _token
                    },
                    success: function(data) {
                        load_comment();
                        $('.noi_dung').val('');
                    }, 
                    error: function(xhr){
                        alert("Lỗi");
                        console.log(xhr);
                        
                    }
                });
            });

            $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            load_comment(page);
    });
        });
        
    </script>
@endsection
