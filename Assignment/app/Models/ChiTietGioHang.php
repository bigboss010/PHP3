<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChiTietGioHang extends Model
{
    use HasFactory;

    public function getCTGH()
    {
        $gioHangCT = DB::table('chi_tiet_gio_hangs as ctgh')
            ->join('gio_hangs as gh', 'ctgh.gio_hang_id', '=', 'gh.id')
            ->join('pets', 'ctgh.pet_id', '=', 'pets.id')
            ->join('users', 'gh.user_id', '=', 'users.id')
            ->select('ctgh.id', 'ctgh.so_luong', 'users.name', 'pets.ten_pet')
            ->orderBY('ctgh.id')
            ->get();
        return $gioHangCT;
    }

    public function createCTGH($data)
    {
        DB::table('chi_tiet_gio_hangs')->insert($data);
    }

    public function updateCTGH($data, $id)
    {
        DB::table('chi_tiet_gio_hangs')->where('id', $id)->update($data);
    }
}
