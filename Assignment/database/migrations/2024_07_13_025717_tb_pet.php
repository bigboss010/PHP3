<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('ma_pet',255)->unique();
            $table->string('ten_pet',255);
            $table->string('image',255)->nullable();
            $table->integer('so_luong');
            $table->double('gia_pet', 11, 2); // lay 8 so, phan thap phan lay 2 so
            $table->double('gia_khuyen_mai', 11, 2); // lay 8 so, phan thap phan lay 2 so
            $table->date('ngay_nhap');
            $table->text('mota')->nullable();//nullable cho phep gia tri la null
            $table->text('mo_ta_chi_tiet')->nullable();
            $table->unsignedBigInteger('danh_muc_id');
            $table->boolean('trang_thai')->default(0);//default xet gia tri mac dinh
            $table->foreign('danh_muc_id')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->unsignedBigInteger('luot_xem')->default(0);
            $table->tinyInteger('is_new')->default(1);
            $table->tinyInteger('is_hot')->default(1);
            $table->tinyInteger('is_home')->default(1);
            $table->tinyInteger('deleted')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
