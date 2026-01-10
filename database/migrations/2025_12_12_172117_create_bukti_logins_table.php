<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bukti_logins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('transaction_item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('image_path');

            $table->string('email_akun');
            $table->string('nama_buyer');

            $table->enum('tipe_akun', ['private', 'sharing']);
            $table->string('durasi');

            // 🔥 TAMBAHAN BARU
            $table->string('device');
            $table->string('lokasi');
            $table->enum('penggunaan', ['pribadi', 'cust']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukti_logins');
    }
};
