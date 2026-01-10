<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();

            // user yang saldo-nya berubah
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // transaksi terkait (boleh null kalau cuma topup atau mutasi manual)
            $table->foreignId('transaction_id')->nullable()->constrained()->nullOnDelete();

            // keterangan pemotongan saldo
            $table->string('description')->nullable();

            // jumlah (bisa minus untuk pembelian, plus untuk top up)
            $table->integer('amount');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_logs');
    }
};
