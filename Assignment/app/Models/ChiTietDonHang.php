<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_don_hangs';
    protected $fillable =[
        'don_hang_id',
        'pet_id',
        'thanh_tien',
        'gia',
        'so_luong',
    ];

    
    public function sanpham()
    {
        return $this->belongsTo(Pet::class);
    }

    public function donHang(){
        return $this->belongsTo(DonHang::class,'don_hang_id');
    }

    public function pet(){
        return $this->belongsTo(Pet::class);
    }

    public function getList()  {
        $list = DB::table('chi_tiet_don_hangs')
        ->join('pets', 'pets.id','=','chi_tiet_don_hangs.pet_id')
        ->join('gio_hangs','gio_hangs.id','=','chi_tiet_don_hangs.gio_hang_id')
        ->select('chi_tiet_don_hangs.*','pets.ten_pet','pets.gia_pet','gio_hangs.user_id')
        ->get();
        return $list;
    }

    public function createChiTietDonHang($data) {
        DB::table('chi_tiet_don_hangs')->insert($data);
    }

    public function updateChiTietDonHang($data,$id) {
        DB::table('chi_tiet_don_hangs')->where('id',$id)->update($data);
    }
}
