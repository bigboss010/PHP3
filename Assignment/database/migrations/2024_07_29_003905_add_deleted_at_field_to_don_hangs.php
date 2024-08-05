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
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->softDeletes();
            $table->foreign('phuong_thuc_thanh_toan_id')->references('id')->on('phuong_thuc_thanh_toans')->onDelete('cascade');
            $table->foreign('trang_thai_id')->references('id')->on('trang_thai_don_hangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropForeign(['phuong_thuc_thanh_toan_id']);
            $table->dropForeign(['trang_thai_id']);
        });
    }
};
