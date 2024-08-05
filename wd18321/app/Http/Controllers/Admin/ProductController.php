<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listProducts() {
        // dd(Auth::user());
        $title = 'Danh sách sản phẩm';
        $listProduct = Product::paginate(5);
        return view('admins.products.index', compact('title', 'listProduct'));
    }

    public function addProduct(){
        $title = 'Thêm mới sản phẩm';
        return view('admins.products.add', compact('title'));
    }

    public function addPostProduct(Request $request){
       if($request->isMethod("POST")){
        $imageUrl = "";
        if($request->hasFile('image')){
            // $fileName = $request->file('image')->store('uploads/products', 'public');
            $image = $request->file('image');
            $nameImage = time() . "." . $image->getClientOriginalExtension();
            $link = "imgProducts/";
            $image->move(public_path($link), $nameImage);

            $imageUrl = $link . $nameImage;
        }else{
            $fileName = null;
        }
        $data = [
            // 'image' => $fileName,
            'image' => $imageUrl,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
           ];
        Product::create($data);
        return redirect()->route('admin.products.listProducts')->with('success', 'Thêm mới thành công!');
       }
     }

     public function delProduct($id){
        $listPD = Product::find($id);
        if($listPD->image){
            File::delete(public_path($listPD->image));
            // Storage::disk('public')->delete($listPD->image);
        }
        $listPD->delete();
        return redirect()->route('admin.products.listProducts')->with('success', 'Xóa thành công!');
    }

    public function detailProduct($id)
    {
        $title = 'Sửa sản phẩm';
        $product = Product::find($id);
        return view('admins.products.update', compact('title', 'product'));
    }

    public function updatePostProduct(Request $request, $id){
        if($request->isMethod("PATCH")){
            $product = Product::find($id);
            $imageUrl = "";
            if($request->hasFile('image')){
                if($product->image){
                    File::delete(public_path($product->image));
                    //  Storage::disk('public')->delete($product->image);
                }
                   // $fileName = $request->file('image')->store('uploads/products', 'public');

                   $image = $request->file('image');
                   $nameImage = time() . "." . $image->getClientOriginalExtension();
                   $link = "imgProducts/";
                   $image->move(public_path($link), $nameImage);
       
                   $imageUrl = $link . $nameImage;
            }else{
                $fileName = null;
            }
            $data = [
                // 'image' => $fileName,
                'image' => $imageUrl,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
               ];
            Product::where('product_id', $id)->update($data);
            return redirect()->route('admin.products.listProducts')->with('success', 'Sửa thành công!');
        }
    }
}
