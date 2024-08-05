<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KhanhController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TinController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// GET POST =>> Method HTTP
// http://127.0.0.1:8000/ =>> Base url
Route::get('/', function(){
    echo 'Trang chủ';
});
Route::get('/test', function(){
    echo '123';
});

Route::get('/list-user', [UserController::class, 'showUser']);

// Route::get('/list-user', function() {
//     $users = [
//         [
//             'id' => '1',
//             'name' => 'khanh'
//         ],
//         [
//             'id' => '2',
//             'name' => 'hai'
//         ]
//         ];
//     return view('list-user')->with(
//         ['abc' => $users]
//     );
// });

// Slug: là một thành phần của đường dẫn
// http://127.0.0.1:8000/get-user/1
Route::get('/get-user/{id}/{name?}', [UserController::class, 'getUser']);

// Params: là id của ng dùng gửi lên
// http://127.0.0.1:8000/edit-user?id=1&name=khanh
Route::get('/edit-user', [UserController::class, 'editUser']);

// Lab 1:
// Bài 1
Route::get('/', [TinController::class, 'index']);
Route::get('/lien-he', [TinController::class, 'lienHe']);

// Bài 2
Route::get('/ct/{id}', [TinController::class, 'lay1Tin']);
// http://localhost:8000/ct/21
// http://localhost:8000/ct/5

// Bài 3
Route::get('/thong-tin-SV', [KhanhController::class, 'showKhanh']);

// http://127.0.0.1:8000/users/list-users
Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
    Route::get('list-users', [UserController::class, 'listUsers'])->name('list-users');
    Route::get('add-users', [UserController::class, 'addUsers'])->name('addUsers'); 
    // bình thường route không được trùng tên nhau nhưng do method khác nhau nên không có lỗi
    Route::post('add-users', [UserController::class, 'addPostUsers'])->name('addPostUsers');
    Route::get('del-users/{id}', [UserController::class, 'delUsers'])->name('delUsers');
    Route::get('detail-users/{id}', [UserController::class, 'detailUsers'])->name('detailUsers');
    Route::post('update-users/{id}', [UserController::class, 'updatePostUsers'])->name('updatePostUsers');

});

Route::get('/login', [AuthenController::class, 'login'])->name('login');
Route::post('/login', [AuthenController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenController::class, 'logout'])->name('logout');
Route::get('/register', [AuthenController::class, 'register'])->name('register');
Route::post('/postRegister', [AuthenController::class, 'postRegister'])->name('postRegister');

// http://127.0.0.1:8000
Route::group([
    'prefix' => 'admin', 
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function(){
    Route::group([
        'prefix' => 'products', 
        'as' => 'products.'
    ], function(){
    Route::get('/', [ProductController::class, 'listProducts'])->name('listProducts');
    Route::get('add-product', [ProductController::class, 'addProduct'])->name('addProduct'); 
    Route::post('add-product', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
    Route::get('del-product/{id}', [ProductController::class, 'delProduct'])->name('delProduct');
    Route::get('detail-product/{id}', [ProductController::class, 'detailProduct'])->name('detailProduct');
    Route::patch('update-product/{id}', [ProductController::class, 'updatePostProduct'])->name('updatePostProduct');
    });
});



