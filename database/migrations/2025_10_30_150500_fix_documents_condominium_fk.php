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
        Schema::table('documents', function (Blueprint $table) {
            // Drop the incorrect foreign key (if it exists)
            $table->dropForeign(['condominium_id']);

            // Add the correct foreign key to condominiums.id
            $table->foreign('condominium_id')
                ->references('id')
                ->on('condominiums')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['condominium_id']);

            // restore previous (incorrect) state to match original migration
            $table->foreign('condominium_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
};
