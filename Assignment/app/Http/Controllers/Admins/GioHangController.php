<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\GioHang;
use App\Models\KhachHang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public $gioHangs;

    public function __construct()
    {
        $this->gioHangs = new GioHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách giỏ hàng';
        $gioHangs = $this->gioHangs->getGioHang();
        return view('admins.gio_hangs.index', compact('title', 'gioHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(KhachHang $users)
    {
        $title = 'Thêm mới giỏ hàng';
        $users = $users->getList();
        return view('admins.gio_hangs.add', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = [
                'user_id' => $request->user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $this->gioHangs->createGioHang($data);
            return redirect()->route('admin.gio-hang.index')->with('success', 'Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, KhachHang $users)
    {
        $title = 'Sửa giỏ hàng';
        $gioHang = $this->gioHangs->find($id);
        if(!$gioHang){
            return redirect()->route('admin.gio-hang.index')->with('errors', 'Giỏ hàng này không tồn tại!');
        }
        $users = $users->getList();
        return view('admins.gio_hangs.update', compact('title', 'gioHang', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $data = [
                'user_id' => $request->user_id,
                'updated_at' => Carbon::now()
            ];
            $this->gioHangs->updateGioHang($data, $id);
            return redirect()->route('admin.gio-hang.index')->with('success', 'Sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gioHang = $this->gioHangs->find($id);
        if(!$gioHang){
            return redirect()->route('admin.gio-hang.index')->with('errors', 'Giỏ hàng này không tồn tại!');
        }
        $gioHang->delete();
        return redirect()->route('admin.gio-hang.index')->with('success', 'Xóa thành công!');
    }
}
