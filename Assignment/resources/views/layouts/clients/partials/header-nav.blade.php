<nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="">
                <a href="{{route('/.index')}}">Trang chủ</a>
              
            </li>
            <li>
                <a href="{{route('/.shop')}}">Cửa hàng</a>
                <ul class="dropdown">
                    {{-- @foreach ($danhMucs as $item)
                    <li><a href="{{route('/.shopDanhMuc', $item->id)}}">{{ $item->ten_danh_muc }}</a></li>
                    @endforeach
                     --}}
                    {{-- <li><a href="{{route('/.cat')}}">Mèo</a></li> --}}
                </ul>
            </li>
            <li><a href="shop.html">Thông tin</a></li>
            <li><a href="contact.html">Liên hệ</a></li>
        </ul>
    </div>
</nav>
