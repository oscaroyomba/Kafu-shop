<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ✅ Only modify if 'name' column exists
        if (Schema::hasColumn('orders', 'name')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('name')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ✅ Revert change only if 'name' column exists
        if (Schema::hasColumn('orders', 'name')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('name')->nullable(false)->change();
            });
        }
    }
};