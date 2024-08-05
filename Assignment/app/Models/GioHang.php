<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GioHang extends Model
{
    use HasFactory;
    protected $table = 'gio_hangs';
    protected $fillable =[
        'user_id',
        'so_luong',
    ];
    public function getGioHang()
    {
        $gioHangs = DB::table('gio_hangs as gh')
            ->join('users', 'gh.user_id', '=', 'users.id')
            ->select(
                'gh.id',
                'gh.created_at',
                'gh.updated_at',
                'users.name',
                'users.email',
            )
            ->orderBY("gh.id")
            ->get();
        return $gioHangs;
    }

    public function createGioHang($data)
    {
        DB::table('gio_hangs')->insert($data);
    }

    public function updateGioHang($data, $id)
    {
        DB::table('gio_hangs')->where('id', $id)->update($data);
    }
}
