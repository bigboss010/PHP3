@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Giỏ hàng</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" action="{{ route('/.cart.update') }}" method="post">
                    @csrf
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Tên thú cưng</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-total">Tổng tiền</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($cartItems))
                                    @foreach ($cartItems as $id => $details)
                                        <tr rowId="{{ $id }}">
                                            <td class="product-thumbnail">
                                                <img src="{{ Storage::url($details['image']) }}" alt="Image"
                                                    class="img-fluid">
                                                <input type="hidden" name="cartItems[{{ $id }}][image]"
                                                    value="{{ $details['image'] }}">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $details['ten_pet'] }}</h2>
                                                <input type="hidden" name="cartItems[{{ $id }}][ten_pet]"
                                                    value="{{ $details['ten_pet'] }}">
                                            </td>
                                            <td class="product-price">
                                                {{ number_format($details['gia_pet'], 0, ',', '.') }} VNĐ
                                                <input type="hidden" name="cartItems[{{ $id }}][gia_pet]"
                                                    value="{{ $details['gia_pet'] }}">
                                            </td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary down" type="button"
                                                            data-id="{{ $id }}">&minus;</button>
                                                    </div>
                                                    <input type="text" class="form-control text-center so_luong"
                                                        data-id="{{ $id }}" min="1"
                                                        value="{{ $details['so_luong'] }}">
                                                    <input type="hidden" name="cartItems[{{ $id }}][so_luong]"
                                                        value="{{ $details['so_luong'] }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary up" type="button"
                                                            data-id="{{ $id }}">&plus;</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-total">
                                                {{ number_format($details['gia_pet'] * $details['so_luong'], 0, ',', '.') }}
                                                VNĐ</td>
                                            <td class="actions">
                                                <a class="btn btn-outline-danger btn-sm delete-product"
                                                    data-id="{{ $id }}"><i class="fa fa-trash-o">X</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><h5>Giỏ hàng trống!</h5></td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm btn-block">Cập nhật giỏ hàng</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-sm btn-block" href="{{ route('/.shop') }}">Tiếp
                                tục mua sắm</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Mã giảm giá</label>
                            <p>Điền mã giảm giá ở đây nếu có.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm">Xác nhận</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Tổng giỏ hàng</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Tổng tiền</span>
                                </div>
                                <div class="col-ml-6 text-right">
                                    <strong class="text-black grand-total">{{ number_format($total, 0, ',', '.') }}
                                        VNĐ</strong>
                                </div>
                            </div>

                            <div class="row">
                                @if (Auth::user())
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-lg py-3 btn-block"
                                            href="{{ route('donhangs.create') }}" style="color: white">Thanh
                                            toán</a>
                                    </div>
                                @elseif(!Auth::user())
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary btn-lg py-3 btn-block" id="checkout"
                                            onclick="showAlert3()" style="color: white">Thanh
                                            toán</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.js') }}"></script>
<script>
    // Xử lý tăng giảm số lượng
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch('{{ route('/.cart.update') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Giỏ hàng đã được cập nhật!');
                        location.reload(); // Reload the page to see the changes
                    } else {
                        alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
                });
        });
       

        document.querySelectorAll('.down').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`.so_luong[data-id="${id}"]`);
                let currentValue = parseInt(input.value);
                if (isNaN(currentValue) || currentValue <= 1) {
                    alert('Số lượng không thể nhỏ hơn 1');
                    input.value = 1;
                } else {
                    input.value = currentValue - 1;
                }
                updateTotal(id);
            });
        });

        document.querySelectorAll('.up').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`.so_luong[data-id="${id}"]`);
                let currentValue = parseInt(input.value);
                if (isNaN(currentValue)) {
                    alert('Vui lòng nhập một số nguyên hợp lệ');
                    input.value = 1;
                } else {
                    input.value = currentValue + 1;
                }
                updateTotal(id);
            });
        });

        document.querySelectorAll('.so_luong').forEach(function(input) {
            input.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            input.addEventListener('input', function() {
                let currentValue = parseInt(this.value);
                if (isNaN(currentValue) || currentValue < 1) {
                    alert('Vui lòng nhập một số nguyên hợp lệ lớn hơn 0');
                    this.value = 1;
                }
                const id = this.getAttribute('data-id');
                updateTotal(id);
            });
        });

        function updateTotal(id) {
            const input = document.querySelector(`.so_luong[data-id="${id}"]`);
            const price = parseInt(document.querySelector(`tr[rowId="${id}"] .product-price`).innerText.replace(
                /\D/g, ''));
            if (isNaN(price)) return;

            const totalElement = document.querySelector(`tr[rowId="${id}"] .product-total`);
            const total = price * parseInt(input.value);
            if (isNaN(total)) return;

            totalElement.innerText = total.toLocaleString('vi-VN') + ' VNĐ';

            // Cập nhật giá trị của trường input ẩn
            document.querySelector(`input[name="cartItems[${id}][so_luong]"]`).value = input.value;
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.product-total').forEach(function(totalElement) {
                const total = parseInt(totalElement.innerText.replace(/\D/g, ''));
                if (!isNaN(total)) {
                    grandTotal += total;
                }
            });
            document.querySelector('.grand-total').innerText = grandTotal.toLocaleString('vi-VN') + ' VNĐ';
        }

        $(document).ready(function() {
            $(".delete-product").click(function(e) {
                e.preventDefault();

                var ele = $(this);
                if (confirm("Bạn chắc chắn muốn xóa pet này chứ?")) {
                    $.ajax({
                        url: '{{ route('/.delete.pet.cart') }}', // Use named route
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("rowId")
                        },
                        success: function(response) {
                            if (response.success) {
                                ele.closest("tr")
                                    .remove(); // Remove the row from the table
                                alert(response.success); // Show success message
                                updateGrandTotal();
                            } else {
                                alert(response.error); // Show error message
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the item.');
                        }
                    });
                }
            });
        });

        updateGrandTotal();
    });



    // Thông báo khi chưa đăng nhập mà đòi thanh toán
    function showAlert3() {
        event.preventDefault();
        Swal.fire({
            title: 'Thông báo',
            text: 'Vui lòng đăng nhập để vào mục này!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
</script>
