<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HinhAnhPet extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'link_anh'
    ];

    public function pet() {
        return $this->belongsTo(Pet::class);
    }

protected $table ='hinh_anh_pets';
    public function getAnhPet()
    {
        $anhPet = DB::table('hinh_anh_pets as ap')
            ->join('pets', 'ap.pet_id', '=', 'pets.id')
            ->select('ap.id', 'ap.link_anh', 'pets.ten_pet')
            ->orderBy('ap.id')
            ->get();
        return $anhPet;
    }

    public function createAnhPet($data)
    {
        DB::table('hinh_anh_pets')->insert($data);
    }

    public function updateAnhPet($data, $id)
    {
        DB::table('hinh_anh_pets')->where('id', $id)->update($data);
    }
}
