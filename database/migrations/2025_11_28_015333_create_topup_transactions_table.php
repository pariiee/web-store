<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('topup_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('transaction_id')->unique();
            $table->integer('amount');
            $table->integer('unique_code');
            $table->integer('total_amount');

            $table->text('qr_string')->nullable();
            $table->text('qr_url')->nullable();

            $table->enum('status', ['pending', 'paid', 'cancel', 'expired'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topup_transactions');
    }
};
