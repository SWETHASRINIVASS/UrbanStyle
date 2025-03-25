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
        Schema::table('sale_returns', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['product_id']);
            // Then drop the column
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_returns', function (Blueprint $table) {
            // Recreate the column and foreign key in the rollback
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
