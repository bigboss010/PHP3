<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Pet extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='pets';

    protected $fillable = [
        'ten_pet',
        'so_luong',
        'gia_pet',
        'gia_khuyen_mai',
        'ngay_nhap',
        'mota',
        'danh_muc_id',
        'trang_thai',
        'image',
        'mo_ta_chi_tiet',
        'luot_xem',
        'is_new',
        'is_hot',
        'is_home',
        'ma_pet',
    ];

    protected $cast = [
        'trang_thai' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_home' => 'boolean'
    ];

    public function danhMuc() {
        return $this->belongsTo(DanhMuc::class);
    }

    public function hinhAnhPet() {
        return $this->hasMany(HinhAnhPet::class);
    }

    public function getPetIndex()
    {
         return DB::table('pets')
            ->join('danh_mucs', 'pets.danh_muc_id', '=', 'danh_mucs.id')
            ->select(
                'pets.id',
                'pets.ma_pet',
                'pets.ten_pet',
                'pets.image',
                'pets.so_luong',
                'pets.gia_pet',
                'pets.gia_khuyen_mai',
                'pets.ngay_nhap',
                'pets.mota',
                'pets.trang_thai',
                'pets.is_new',
                'pets.is_hot',
                'pets.is_home',
                'pets.luot_xem',
                'pets.deleted',
                'pets.deleted_at',
                'pets.created_at',
                'pets.updated_at',
                'danh_mucs.ten_danh_muc'
            )
            ->orderBy('pets.id');
    }
    public function getPet()
{
    return DB::table('pets')
        ->join('danh_mucs', 'pets.danh_muc_id', '=', 'danh_mucs.id')
        ->select(
            'pets.id',
            'pets.ma_pet',
            'pets.ten_pet',
            'pets.image',
            'pets.so_luong',
            'pets.gia_pet',
            'pets.gia_khuyen_mai',
            'pets.ngay_nhap',
            'pets.mota',
            'pets.trang_thai',
            'pets.is_new',
            'pets.is_hot',
            'pets.is_home',
            'pets.luot_xem',
            'pets.deleted',
            'pets.deleted_at',
            'pets.created_at',
            'pets.updated_at',
            'danh_mucs.ten_danh_muc'
        )
        ->orderBy('pets.id');
}

    public function createPet($data)
    {
        DB::table('pets')->insert($data);
    }

    public function updatePet($data, $id)
    {
        DB::table('pets')->where('id', $id)->update($data);
    }
}
