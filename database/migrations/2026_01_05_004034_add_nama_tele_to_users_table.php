<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom nama_tele
            $table->string('nama_tele')->nullable()->after('whatsapp');
            
            // Buat email menjadi nullable karena akan di-generate otomatis
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nama_tele');
            $table->string('email')->nullable(false)->change();
        });
    }
};