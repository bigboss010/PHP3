<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ChiTietGioHang;
use App\Models\GioHang;
use App\Models\Pet;
use Illuminate\Http\Request;

class CTGioHangController extends Controller
{
    public $gioHangCT;

    public function __construct()
    {
        $this->gioHangCT = new ChiTietGioHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách chi tiết giỏ hàng';
        $gioHangCT = $this->gioHangCT->getCTGH();
        return view('admins.chi_tiet_gio_hangs.index', compact('title', 'gioHangCT'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GioHang $gioHangs, Pet $pets)
    {
        $title = 'Thêm mới chi tiết giỏ hàng';
        $gioHangs = $gioHangs->getGioHang();
        $pets = $pets->getPet();
        return view('admins.chi_tiet_gio_hangs.add', compact('title', 'gioHangs', 'pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = [
                'gio_hang_id' => $request->gio_hang_id,
                'pet_id' => $request->pet_id,
                'so_luong' => $request->so_luong,

            ];
            $this->gioHangCT->createCTGH($data);
            return redirect()->route('admin.chi-tiet-gio-hang.index')->with('success', 'Thêm mới thành công!');
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
    public function edit(string $id, GioHang $gioHangs, Pet $pets)
    {
        $title = 'Sửa chi tiết giỏ hàng';
        $gioHangCT = $this->gioHangCT->find($id);
        if(!$gioHangCT){
            return redirect()->route('admin.chi-tiet-gio-hang.index')->with('errors', 'Chi tiết giỏ hàng này không tồn tại!');
        }
        $gioHangs = $gioHangs->getGioHang();
        $pets = $pets->getPet();
        return view('admins.chi_tiet_gio_hangs.update', compact('title', 'gioHangCT', 'gioHangs', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
            $data = $request->except('_method', '_token');
            $this->gioHangCT->updateCTGH($data, $id);
            return redirect()->route('admin.chi-tiet-gio-hang.index')->with('success', 'Sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gioHangCT = $this->gioHangCT->find($id);
        if(!$gioHangCT){
            return redirect()->route('admin.chi-tiet-gio-hang.index')->with('errors', 'Chi tiết giỏ hàng này không tồn tại!');
        }
        $gioHangCT->delete();
        return redirect()->route('admin.chi-tiet-gio-hang.index')->with('success', 'Xóa thành công!');
    }
}
