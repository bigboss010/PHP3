<div class="site-navbar-top">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <form action="{{ route('/.shopSearch')}}" method="POST" class="site-block-top-search">
                    @csrf
                    <span class="icon icon-search2"></span>
                    <input type="text" class="form-control border-0" name="search" placeholder="Tìm kiếm....">
                </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                <div class="site-logo">
                    <a href="{{ route('/.index') }}" class="js-logo-clone">BK-Pets</a>
                </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                <div class="site-top-icons">
                    <ul>
                        <li>
                            <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-person"></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (Auth::user())
                                    @if (Auth::user()->chuc_vu_id == 1)
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="fas fa-user-shield fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Admin
                                        </a>
                                    @endif
                                @endif
                                @if (Auth::user())
                                    <a class="dropdown-item" href="{{ route('/.profile') }}">
                                        <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>                                 
                                        Tài khoản của tôi
                                    </a>
                                @endif
                                @if (Auth::user())
                                    <a class="dropdown-item" href="{{ route('/.donhang') }}">
                                        <i class="icon icon-shopping_cart fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đơn hàng
                                    </a>
                                @endif
                                @if (Auth::user())
                                    <a class="dropdown-item" onclick="showAlert()" id="logout" href="#">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                @elseif(!Auth::user())
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng nhập
                                    </a>
                                @endif
                            </div>
                        </li>
                        </li>
                        <li>
                            <a href="{{ route('/.cart') }}" class="site-cart">
                                <span class="icon icon-shopping_cart"></span>
                                <span class="count">{{ $uniquePetsCount ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.js')}}"></script>
<script>
    //   document.getElementById('!profile').addEventListener('click', function() {
    //       Swal.fire({
    //           title: 'Thông báo',
    //           text: 'Vui lòng đăng nhập để vào mục này!',
    //           icon: 'error',
    //           confirmButtonText: 'OK'
    //       });
    //   });

      function showAlert() {
            event.preventDefault();
            Swal.fire({
                title: 'Thông báo',
                text: 'Bạn có chắc chắn muốn đăng xuất không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đăng xuất',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Thông báo',
                        text: 'Đăng xuất thành công!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/logout';
                    });
                }
            });
        }
  </script>
