<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\TrangThaiDonHang;
use Illuminate\Http\Request;

class TrangThaiDonHangController extends Controller
{
    protected $trang_thai_don_hang;

    public function __construct()
    {
        $this->trang_thai_don_hang = new TrangThaiDonHang();
    }
    public function index()
    {
        $title ="Danh sách trạng thái";
        $list = $this->trang_thai_don_hang ->getList();
        return view('admins.trangthaidonhang.index',[
            'title' => $title,
            'list' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ="Thêm mới trạng thái";
       
        return view('admins.trangthaidonhang.create',[
            'title' => $title,
         
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
            $this->trang_thai_don_hang->createTrangThai($params);
            return redirect()->route('admin.trang_thai_don_hangs.index')->with('success','Thêm mới thành công!');
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
    public function edit(string $id)
    {   
        $tile ="Sửa trạng thái đơn hàng";
        $list = $this->trang_thai_don_hang->find($id);
        if(!$list){
            return redirect()->route('admin.trang_thai_don_hangs.index')->with('errors','Không có trạng thái này!');
        }
        return view('admins.trangthaidonhang.update',[
            'title'=>$tile,
            'list'=>$list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $list = $this->trang_thai_don_hang->find($id);
        $data = $request->except('_token','_method');
        $this->trang_thai_don_hang->updateTrangThai($data,$id);
        return redirect()->route('admin.trang_thai_don_hangs.index')->with('success','Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = $this->trang_thai_don_hang->find($id);
        $list->delete();
        return redirect()->route('admin.trang_thai_don_hangs.index')->with('success','Xóa thành công!');
    }
}
