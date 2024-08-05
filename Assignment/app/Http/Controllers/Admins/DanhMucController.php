<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DanhMucController extends Controller
{
    public $danhMucs;

    public function __construct()
    {
        $this->danhMucs = new DanhMuc();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách danh mục';
        $listDanhMucs = $this->danhMucs->getListDM()->where('deleted', 0)->paginate(5);
        return view('admins.danh_mucs.index', compact('listDanhMucs', 'title'));
    }

    public function trash()
    {
        $list = $this->danhMucs->getListDM()->where('deleted', 1)->paginate(5);
        $title ="Thùng rác";
        return view('admins.danh_mucs.trash',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới danh mục';
        return view('admins.danh_mucs.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('hinh_anh')) {
            $fileName = $request->file('hinh_anh')->store('uploads/danh_mucs', 'public');
        } else {
            $fileName = null;
        }

        $dataInsert = [
            'hinh_anh' => $fileName,
            'ten_danh_muc' => $request->ten_danh_muc,
            'mo_ta' => $request->mo_ta
        ];

        $this->danhMucs->createDanhMuc($dataInsert);
        return redirect()->route('admin.danh-muc.index')->with('success', 'Thêm mới thành công!');
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
        $title = 'Sửa danh mục';
        $danhMuc = $this->danhMucs->find($id);
        if (!$danhMuc) {
            return redirect()->route('admin.danh-muc.index')->with('errors', 'Danh mục này không tồn tại!');
        }
        return view('admins.danh_mucs.update', compact('danhMuc', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $danhMuc = $this->danhMucs->find($id);
        if ($request->hasFile('hinh_anh')) {
            if ($danhMuc->hinh_anh) {
                Storage::disk('public')->delete($danhMuc->hinh_anh);
            }
            $fileName = $request->file('hinh_anh')->store('uploads/danh_mucs', 'public');
        } else {
            $fileName = $danhMuc->hinh_anh;
        }

        $dataUpdate = [
            'hinh_anh' => $fileName,
            'ten_danh_muc' => $request->ten_danh_muc,
            'mo_ta' => $request->mo_ta
        ];

        $this->danhMucs->updateDanhMuc($dataUpdate, $id);
        return redirect()->route('admin.danh-muc.index')->with('success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhMuc = $this->danhMucs->find($id);
        if (!$danhMuc) {
            return redirect()->route('admin.danh-muc.index')->with('errors', 'Danh mục này không tồn tại!');
        }
        if ($danhMuc->hinh_anh) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }
        $danhMuc->delete();
        return redirect()->route('admin.danh-muc.index')->with('success', 'Xóa thành công!');
    }

    public function delete(DanhMucRequest $request)
    {
        $list = DanhMuc::findOrFail($request->id);
        $list->deleted = 1;
        $list->save();
        $list->delete();
        return redirect()->route('admin.danh-muc.index')->with('success','Xóa thành công!');

    }
    public function restore(DanhMucRequest $request)
    {
        $list = DanhMuc::withTrashed()->findOrFail($request->id);
        $list->deleted = 0;
        $list->save();
        $list->restore();
        return redirect()->route('admin.danh-muc.index')->with('success', 'Khôi phục thành công!');
    }
}
