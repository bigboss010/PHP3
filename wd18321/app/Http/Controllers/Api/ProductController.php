<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProduct(){
        $listProduct = Product::select('name', 'price', 'description', 'image')->get();
        return response()->json([
            'data' => $listProduct,
            'status_code' => '200',
            'msg' => 'success'
        ], 200);
    }

    public function detailProduct($id){
        $detailPR = Product::query()->select('product_id', 'name', 'price', 'description', 'image')->find($id);
        return response()->json([
            'data' => $detailPR,
            'status_code' => '200',
            'msg' => 'success'
        ], 200);
    }

    public function addProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price
        ];

        $newProduct = Product::create($data);
        return response()->json([
            'data' => $newProduct,
            'msg' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function updateProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price
        ];

        $updateProduct = Product::find($request->product_id);
        $updateProduct->update($data);
        return response()->json([
            'data' => $updateProduct,
            'msg' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function deleteProduct(Request $request){
        $request->validate([
            'product_id' => 'required'
        ]);
        Product::find($request->product_id)->delete();
        return response()->json([
            'msg' => 'Xóa thành công!',
            'status_code' => '200'
        ], 200);
    }
}
