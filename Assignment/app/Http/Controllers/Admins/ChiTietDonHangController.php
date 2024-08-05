<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\GioHang;
use App\Models\Pet;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
{
    protected $ct_don_hang;
    public $pets;
    public $gioHangs;

    public function __construct()
    {
        $this->ct_don_hang = new ChiTietDonHang();
        $this->pets = new Pet();
        $this->gioHangs = new GioHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách chi tiết đơn hàng";
        $list = $this->ct_don_hang->getList();
        return view('admins.chitietdonhang.index',[
            'title'=>$title,
            'list'=>$list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới chi tiết đơn hàng";
        $listP = $this->pets->getPet();
        $listGH = $this->gioHangs->getGioHang();
        return view('admins.chitietdonhang.create',[
            'title'=>$title,
            'listP'=>$listP,
            'listGH'=>$listGH,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $params = $request->post();
            unset($params['_token']);
            $this->ct_don_hang->createChiTietDonHang($params);
            return redirect()->route('admin.chi_tiet_don_hangs.index')->with('success','Thêm mới thành công!');
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
        $title = "Edit Chi tiết hóa đơn";
        $list = $this->ct_don_hang->find($id);
        if(!$list){
            return redirect()->route('admin.chi_tiet_don_hangs.index')->with('errors','Không tồn tại hóa đơn này!');
        }
        $gioHangs = $gioHangs->getGioHang();
        $pets = $pets->getPet(); 
        return view('admins.chitietdonhang.update', [
            'title' => $title,
            'list' => $list,
            'gioHangs' => $gioHangs,
            'pets' => $pets,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $list = $this->ct_don_hang->find($id);
        $data= $request->except('_token','_method');
        if(!$list){
            return redirect()->route('admin.chi_tiet_don_hangs.index')->with('errors','Không tồn tại hóa đơn này!');
        }
        $list->updateChiTietDonHang($data,$id);
        return redirect()->route('admin.chi_tiet_don_hangs.index')->with('success','Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = $this->ct_don_hang->find($id);
        if(!$list){
            return redirect()->route('admin.chi_tiet_don_hangs.index')->with('errors','Không tồn tại hóa đơn này!');
        }
        $list->delete();
        return redirect()->route('admin.chi_tiet_don_hangs.index')->with('success','Xóa thành công!');

    }
}
