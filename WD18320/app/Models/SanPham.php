<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SanPham extends Model
{
    use HasFactory;

    // Cách 1: Sử dụng Raw Query (SQL thuần)
    // public function getList(){
    //     $listSanPham = DB::select('SELECT * FROM san_phams ORDER BY id DESC');
    //     return $listSanPham;
    // }

    // Cách 2: Sử dụng Query Builer
    public function getList(){
        return DB::table('san_phams')
        ->orderByDesc('id');
     
    }

    public function addSanPham($data){
         DB::table('san_phams')->insert($data);
    }

    public function updateSanPham($data, $id){
         DB::table('san_phams')->where('id', $id)->update($data);
    }

    public function deleteSanPham($id){
        DB::table('san_phams')->where('id', $id)->delete();
   }

    // Cách 3: Sử dụng Eloquent
    use SoftDeletes; // Xóa mềm bằng eloquent 
    protected $table = 'san_phams';
    protected $fillable = [
        'hinh_anh',
        'ma_san_pham',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'mota',
        'trang_thai'
    ];
}
