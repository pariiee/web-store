<?php
// database/migrations/[timestamp]_create_redeem_codes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redeem_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['saldo', 'stock']);
            $table->enum('distribution_type', ['rata', 'acak'])->default('rata');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('total_saldo')->nullable();
            $table->unsignedInteger('max_users')->nullable();
            $table->json('per_user_saldo')->nullable();
            $table->unsignedInteger('total_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')
                ->references('id')->on('items')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redeem_codes');
    }
};