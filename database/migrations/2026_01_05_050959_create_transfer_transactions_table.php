<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfer_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('admin_fee')->default(0);
            $table->bigInteger('total_deducted')->default(0);
            $table->string('status')->default('pending');
            $table->string('note')->nullable();
            $table->timestamp('transfer_date');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['sender_id', 'status']);
            $table->index(['receiver_id', 'status']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfer_transactions');
    }
};