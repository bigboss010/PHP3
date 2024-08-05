<div class="bg-primary header">
    <h3 class="text-light layer">
        <span>Shoppe</span>
        <span>Quản lý sản phẩm</span>
    </h3>

    <div class="dropdown">
        <img class="dropdown-toggle" src="{{ asset('assets/image/avatar.jpg') }}" alt="" id="dropdownMenuButton1"
            data-bs-toggle="dropdown">
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">My profile</a></li>
            <li><a class="dropdown-item" href="#">Language</a></li>
            <li><a class="dropdown-item" href="{{ route('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>