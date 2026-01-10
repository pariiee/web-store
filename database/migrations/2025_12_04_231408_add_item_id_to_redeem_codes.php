<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('redeem_codes', function (Blueprint $table) {
            if (!Schema::hasColumn('redeem_codes', 'item_id')) {
                $table->foreignId('item_id')->nullable()->after('type')->constrained()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('redeem_codes', function (Blueprint $table) {
            if (Schema::hasColumn('redeem_codes', 'item_id')) {
                $table->dropForeign(['item_id']);
                $table->dropColumn('item_id');
            }
        });
    }
};
