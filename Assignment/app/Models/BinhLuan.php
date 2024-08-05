<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BinhLuan extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'user_id ',
        'pet_id ',
        'noi_dung',
        'thoi_gian'
    ];

    public function getBinhluan()
    {
        $binhLuans = DB::table('binh_luans as bl')
            ->join('users', 'bl.user_id', '=', 'users.id')
            ->join('pets', 'bl.pet_id', '=', 'pets.id')
            ->select(
                'bl.id',
                'bl.noi_dung',
                'bl.thoi_gian',
                'bl.trang_thai',
                'bl.created_at',
                'bl.updated_at',
                'users.name',
                'pets.ten_pet'
            )
            ->orderBY('bl.id')
            ->get();
        return $binhLuans;
    }
    public function getBL()
    {
        $binhLuans = DB::table('binh_luans as bl')
            ->join('users', 'bl.user_id', '=', 'users.id')
            ->join('pets', 'bl.pet_id', '=', 'pets.id')
            ->select(
                'bl.id',
                'bl.noi_dung',
                'bl.thoi_gian',
                'bl.trang_thai',
                'bl.created_at',
                'bl.updated_at',
                'users.name',
                'pets.ten_pet'
            )
            ->orderBY('bl.id');
        return $binhLuans;
    }

    public function createBL(array $data)
{
    return BinhLuan::create($data);
}


    public function updateBL($data, $id)
    {
        DB::table('binh_luans')->where("id", $id)->update($data);
    }
}
