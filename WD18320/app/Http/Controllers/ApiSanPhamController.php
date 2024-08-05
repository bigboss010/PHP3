<?php

namespace App\Http\Controllers;

use App\Http\Resources\SanPhamResource;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanPham = SanPham::query()->paginate(5);
        return SanPhamResource::collection($sanPham);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            // Xử lí ảnh
            if ($request->hasFile('hinh_anh')) {
                $fileName = $request->file('hinh_anh')->store('uploads/sanPham', 'public');
            } else {
                $fileName = null;
            }
            $data['hinh_anh'] = $fileName;

            // Sử dụng Eloquent
            $sanPham = SanPham::create($data);
            return new SanPhamResource($sanPham);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $data = $request->all();
            $listSanPham = SanPham::findOrFail($id);
            if ($request->hasFile('hinh_anh')) {
                if ($listSanPham->hinh_anh) {
                    Storage::disk('public')->delete($listSanPham->hinh_anh);
                }
                $fileName = $request->file('hinh_anh')->store('uploads/sanPham', 'public');
            } else {
                $fileName = $listSanPham->hinh_anh;
            }
            $data['hinh_anh'] =  $fileName;
            $listSanPham->update($data);
            return New SanPhamResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listSanPhams = SanPham::findOrFail($id);
        $listSanPhams->delete();
        return response()->json(['success', 'Xóa phẩm thành công!'], 200);
    }
}
