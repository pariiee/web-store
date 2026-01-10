<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->string('type')->default('purchase')->after('amount');
            
            $table->foreignId('transfer_id')->nullable()->after('transaction_id');
            
            $table->index(['user_id', 'type']);
            $table->index(['transfer_id']);
        });
    }

    public function down(): void
    {
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'type']);
            $table->dropIndex(['transfer_id']);
            $table->dropColumn(['type', 'transfer_id']);
        });
    }
};