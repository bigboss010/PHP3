<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $primaryKey = 'product_id';
    public $fillable = [
        'image',
        'name',
        'price',
        'description'
    ];
    
    // public $primaryKey = 'id'; // Mặc định là id nên không cần khai báo
    // public $incrementing = true; // Nếu primary không phải số thì đặt false
    // public $timestamps = true; // Nếu không muốn ghi created_at và updated_at thì đặt false
}
