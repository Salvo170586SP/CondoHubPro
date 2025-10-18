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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('condominium_id');
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->string('unit_number')->nullable(); // es. "Int. 3" o "Scala A - Int. 2"
            $table->string('floor')->nullable(); // es. "2° piano"
            $table->decimal('square_metres', 6, 2)->nullable();
            $table->integer('rooms')->nullable();
            $table->timestamps();

            $table->foreign('condominium_id')->references('id')->on('condominiums')->onDelete('cascade');
            $table->foreign('resident_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
