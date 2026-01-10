<?php
// database/migrations/[timestamp]_create_redeem_claims_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('redeem_claims', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('redeem_code_id')->nullable();

            $table->foreign('redeem_code_id')
                ->references('id')->on('redeem_codes')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('reward_type', ['saldo', 'stock']);

            // saldo
            $table->unsignedBigInteger('saldo_awarded')->nullable();

            // stock
            $table->unsignedInteger('stock_awarded')->nullable();
            $table->json('data_stock')->nullable();

            $table->timestamps();

            // 1 user hanya bisa redeem 1x per kode
            $table->unique(['redeem_code_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redeem_claims');
    }
};