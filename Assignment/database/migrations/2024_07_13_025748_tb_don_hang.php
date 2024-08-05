<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('ten_nguoi_nhan');
            $table->string('email_nguoi_nhan');
            $table->string('so_dien_thoai_nguoi_nhan');
            $table->text('dia_chi_nguoi_nhan');
            $table->timestamp('ngay_dat')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('tong_tien', 15, 2);
            $table->text('ghi_chu')->nullable();
            $table->unsignedBigInteger('phuong_thuc_thanh_toan_id')->default(1);
            $table->unsignedBigInteger('trang_thai_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
