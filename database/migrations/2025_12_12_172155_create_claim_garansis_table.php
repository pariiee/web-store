<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('claim_garansis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('bukti_login_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique(); // 🔥 1 bukti login = 1 garansi

            $table->foreignId('transaction_item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('image_path');

            $table->date('tanggal_order');
            $table->date('tanggal_bermasalah');

            $table->string('sisa_durasi');

            $table->string('email_akun');
            $table->string('password_akun');

            // 🔥 TAMBAHAN BARU
            $table->string('device');
            $table->string('lokasi');
            $table->enum('penggunaan', ['pribadi', 'cust']);

            $table->text('permasalahan');
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_garansis');
    }
};
