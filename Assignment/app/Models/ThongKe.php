<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongKe extends Model
{
    use HasFactory;

    protected $table = 'thong_kes';
    protected $fillable =[
        'don_hang_id',
        'ngay_dat',
        'thanh_tien',
        'so_luong',
    ];

    public function donHang(){
        return $this->belongsTo(DonHang::class,'don_hang_id');
    }
}
