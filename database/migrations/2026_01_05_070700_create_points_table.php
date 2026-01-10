<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('month'); // 1-12
            $table->integer('year'); // 2024, 2025, etc
            $table->integer('total_items')->default(0); // jumlah item yang dibeli
            $table->integer('points')->default(0); // total points
            $table->timestamps();
            
            // Unique constraint untuk satu user per bulan/tahun
            $table->unique(['user_id', 'month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};