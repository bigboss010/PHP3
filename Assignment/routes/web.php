<?php

use App\Http\Controllers\Admins\BinhLuanController;
use App\Http\Controllers\Admins\ChucVuController;
use App\Http\Controllers\Admins\CTGioHangController;
use App\Http\Controllers\Admins\TrangThaiDonHangController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\Admins\DonHangController;
use App\Http\Controllers\Admins\GioHangController;
use App\Http\Controllers\Admins\HinhAnhPetController;
use App\Http\Controllers\Admins\PetController;
use App\Http\Controllers\Admins\PhuongThucThanhToanController;
use App\Http\Controllers\Admins\ChiTietDonHangController;
use App\Http\Controllers\Admins\DashBoardController;
use App\Http\Controllers\Admins\ProfileController;
use App\Http\Controllers\Admins\SliderController;
use App\Http\Controllers\Admins\ThongKeController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\clients\OrderController;
use App\Http\Controllers\clients\PetControllerView;
use App\Models\DonHang;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthenController::class, 'login'])->name('login');
Route::post('/login', [AuthenController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenController::class, 'logout'])->name('logout');
Route::get('/register', [AuthenController::class, 'register'])->name('register');
Route::get('/verify/email/{token}', [AuthenController::class, 'verifyAccount'])->name('verify.email');
Route::post('/postRegister', [AuthenController::class, 'postRegister'])->name('postRegister');

Route::get('admins/khachhang/trash', [UserController::class, 'trash']);
Route::post('admins/khachhang/delete', [UserController::class, 'delete'])->name('admin.khachhang.delete');
Route::post('admins/khachhang/restore', [UserController::class, 'restore'])->name('admin.khachhang.restore');
Route::get('admins/donhang/trash', [DonHangController::class, 'trash']);
Route::post('admins/donhang/delete', [DonHangController::class, 'delete'])->name('admin.donhang.delete');
Route::post('admins/donhang/restore', [DonHangController::class, 'restore'])->name('admin.donhang.restore');
Route::get('admins/donhang/trash', [DonHangController::class, 'trash']);
Route::post('admins/danh-mucs/delete', [DanhMucController::class, 'delete'])->name('admin.danh-mucs.delete');
Route::post('admins/danh-mucs/restore', [DanhMucController::class, 'restore'])->name('admin.danh-mucs.restore');
Route::get('admins/danh-mucs/trash', [DanhMucController::class, 'trash']);
Route::post('admins/pets/delete', [PetController::class, 'delete'])->name('admin.pets.delete');
Route::post('admins/pets/restore', [PetController::class, 'restore'])->name('admin.pets.restore');
Route::get('admins/pets/trash', [PetController::class, 'trash']);
Route::post('admins/binh-luans/delete', [BinhLuanController::class, 'delete'])->name('admin.binh-luans.delete');
Route::post('admins/binh-luans/restore', [BinhLuanController::class, 'restore'])->name('admin.binh-luans.restore');
Route::get('admins/binh-luans/trash', [BinhLuanController::class, 'trash']);
Route::post('admins/sliders/delete', [SliderController::class, 'delete'])->name('admin.sliders.delete');
Route::post('admins/sliders/restore', [SliderController::class, 'restore'])->name('admin.sliders.restore');
Route::get('admins/sliders/trash', [SliderController::class, 'trash']);
Route::get('admins/thongke', [ThongKeController::class, 'thongke']);
Route::post('/filter-by-date', [ThongKeController::class, 'filter_by_date']);
Route::post('/dashboard-filter', [ThongKeController::class, 'dashboard_filter']);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function () {
    Route::resource('/', DashBoardController::class);
    Route::resource('users', UserController::class);
    Route::resource('chuc_vus', ChucVuController::class);
    Route::resource('trang_thai_don_hangs', TrangThaiDonHangController::class);
    Route::resource('phuong_thuc_thanh_toans', PhuongThucThanhToanController::class);
    Route::resource('don_hangs', DonHangController::class);
    Route::resource('chi_tiet_don_hangs', ChiTietDonHangController::class);
    Route::resource('danh-muc', DanhMucController::class);
    Route::resource('pet', PetController::class);
    Route::resource('gio-hang', GioHangController::class);
    Route::resource('chi-tiet-gio-hang', CTGioHangController::class);
    Route::resource('binh-luan', BinhLuanController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('slider', SliderController::class);
  

   
});

Route::group([
    'prefix' => '/',
    'as' => '/.'
], function () {
    Route::get('/', [PetControllerView::class, 'index'])->name('index');
    Route::get('/shop', [PetControllerView::class, 'shop'])->name('shop');
    Route::post('/shop-search', [PetControllerView::class, 'shopSearch'])->name('shopSearch');
    Route::get('/shop-single/{id}', [PetControllerView::class, 'shopSingle'])->name('shop-single');
    Route::get('/add-to-cart/{id}/{so_luong}', [PetControllerView::class, 'addPetToCart'])->name('addPetToCart');
    Route::post('/update-cart', [PetControllerView::class, 'updateCart'])->name('cart.update');
    Route::group([
        'middleware' => 'checkUser'
    ], function () {
        Route::get('/shop-cart', [PetControllerView::class, 'showCart'])->name('cart');
        Route::get('/thank', [PetControllerView::class, 'thank'])->name('thank');
    });
    Route::delete('/delete-pet-cart', [PetControllerView::class, 'deletePetCart'])->name('delete.pet.cart');
    Route::get('/profile', [PetControllerView::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit/{id}', [PetControllerView::class, 'profileEdit'])->name('profileEdit');
    Route::get('/profile/update/{id}', [PetControllerView::class, 'profileUpdate'])->name('profileUpdate');
    Route::get('/donhang', [PetControllerView::class, 'showDonHang'])->name('donhang');
    // Route::post('/add-donhang', [PetControllerView::class, 'addDonHang'])->name('addonhang');
    Route::get('/donhang/detail/{id}', [PetControllerView::class, 'showDetailDonHang'])->name('showDetailDonHang');
    Route::put('/donhang/update/{id}', [PetControllerView::class, 'updateDonHang'])->name('updateDonHang');
    Route::post('/binh-luan', [BinhLuanController::class, 'load_comment'])->name('load_comment');
    Route::post('/send-binh-luan', [PetControllerView::class, 'send_comment'])->name('send_comment');
    Route::get('/shop-danh-muc/{id}', [PetControllerView::class, 'shopDanhMuc'])->name('shopDanhMuc');
    // Route::get('/checkout', [PetControllerView::class, 'checkout'])->name('checkout');



});
    Route::middleware('auth')->prefix('donhangs')
    ->as('donhangs.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::put('/{id}/update', [OrderController::class, 'update'])->name('update');
    });
