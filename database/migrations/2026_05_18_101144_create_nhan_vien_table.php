<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Ham up(): Thuc thi khi chay lenh migrate (Dung de tao bang)
    public function up(): void
    {
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->id();
            $table->string('ma_nv', 10)->unique();
            $table->string('ten_nv', 100);
            $table->integer('tuoi');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // Ham down(): Thuc thi khi chay lenh rollback (Dung de xoa bang)
    public function down(): void
    {
        Schema::dropIfExists('nhan_vien');
    }
};
