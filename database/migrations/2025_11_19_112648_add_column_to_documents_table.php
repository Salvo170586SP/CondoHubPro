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
            $table->unsignedBigInteger('notice_board_id')->nullable()->change();
            $table->unsignedBigInteger('condominium_id')->nullable()->change();

            $table->unsignedBigInteger('payment_id')->nullable()->after('condominium_id');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('notice_board_id')->nullable(false)->change();
            $table->unsignedBigInteger('condominium_id')->nullable(false)->change();
            $table->dropForeign(['payment_id']);
            $table->dropColumn('payment_id');
        });
    }
};
