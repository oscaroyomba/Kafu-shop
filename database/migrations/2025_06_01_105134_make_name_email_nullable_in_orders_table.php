<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations — make 'name' and 'email' nullable
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable()->change();   // ✅ allow null
            $table->string('email')->nullable()->change();  // ✅ allow null
        });
    }

    /**
     * Reverse the migrations — make 'name' and 'email' NOT nullable again
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();   // ❌ back to required
            $table->string('email')->nullable(false)->change();  // ❌ back to required
        });
    }
};