<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nhan_vien', function (Blueprint $table) {
            // 1. Them cot moi
            $table->string('sdt', 15)->nullable()->after('tuoi');

            // 2. Xoa cot hien tai
            $table->dropUnique(['email']);
            $table->dropColumn('email');

            // 3. Thay doi thuoc tinh cot
            $table->string('ten_nv', 255)->change();
        });
    }

    public function down(): void
    {
        // Phuc hoi lai trang thai truoc khi cap nhat
        Schema::table('nhan_vien', function (Blueprint $table) {
            $table->dropColumn('sdt');
            $table->string('email')->unique();
            $table->string('ten_nv', 100)->change();
        });
    }
};