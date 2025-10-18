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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_board_id')->nullable();
            $table->unsignedBigInteger('condominium_id')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->string('name_file');
            $table->string('url_pdf');
            $table->string('mime_type');  
            $table->timestamps();

            $table->foreign('notice_board_id')->references('id')->on('notice_boards')->onDelete('cascade');
            $table->foreign('condominium_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
