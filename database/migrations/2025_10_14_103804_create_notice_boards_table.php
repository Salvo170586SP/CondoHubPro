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
        Schema::create('notice_boards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condominium_id');
            $table->string('title');
            $table->text('description'); 
            $table->string('type'); // avviso, documento, comunicazione
            $table->string('url_pdf')->nullable();  
            $table->unsignedBigInteger('created_by')->nullable();  // es: amministratore Mario Rossi
            $table->timestamps();

            $table->foreign('condominium_id')->references('id')->on('condominiums')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_boards');
    }
};
