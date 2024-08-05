<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    protected $chuc_vu;

    public function __construct()
    {
        $this->chuc_vu = new ChucVu();
    }
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->chuc_vu ->getList();
        $title = "Danh sách chức vụ";
        return view('admins.chucvu.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới chức vụ";
        $list = $this->chuc_vu ->getList();
        return view('admins.chucvu.create',compact('title','list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $params = $request->post();
            unset($params['_token']);

            $this->chuc_vu->createChucVu($params);
            return redirect()->route('admin.chuc_vus.index')->with('success','Thêm mới thành công!');
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
        $list = $this->chuc_vu ->find($id);
        $title = "Edit chức vụ";
        if(!$list){
            return redirect()->route('admin.chuc_vus.index')->with('errors','Không tồn tại chức vụ này!');
        }
        return view('admins.chucvu.update',compact('title','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $list= $this->chuc_vu ->find($id);
        if(!$list){
            return redirect()->route('admin.chuc_vus.index');
        }
        $dataUpdate = [
            'ten_chuc_vu' => $request->ten_chuc_vu,
        ];
        $this->chuc_vu->updateChucVu($dataUpdate,$id);
        return redirect()->route('admin.chuc_vus.index')->with('success','Sửa chức vụ thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list= $this->chuc_vu ->find($id);
        if(!$list){
            return redirect()->route('admin.chuc_vus.index');
        }
        $list->delete();
        return redirect()->route('admin.chuc_vus.index')->with('success','Xóa thành công!');
    }
}
