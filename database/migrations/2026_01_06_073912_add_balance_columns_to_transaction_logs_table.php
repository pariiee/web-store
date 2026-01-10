<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('transaction_logs', 'balance_before')) {
                $table->integer('balance_before')->nullable()->after('amount');
            }
            
            if (!Schema::hasColumn('transaction_logs', 'balance_after')) {
                $table->integer('balance_after')->nullable()->after('balance_before');
            }
            
            if (!Schema::hasColumn('transaction_logs', 'metadata')) {
                $table->json('metadata')->nullable()->after('balance_after');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->dropColumn(['balance_before', 'balance_after', 'metadata']);
        });
    }
};