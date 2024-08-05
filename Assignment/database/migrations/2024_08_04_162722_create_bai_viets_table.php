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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('danh_muc_id');
            $table->string('tieu_de');
            $table->string('hinh_anh')->nullable();
            $table->string('mo_ta');
            $table->text('noi_dung');
            $table->tinyInteger('deleted')->default(0);
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_bai_viets')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};