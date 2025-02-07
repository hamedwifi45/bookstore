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
        Schema::create('book_auther', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auther_id');
            $table->unsignedBigInteger('book_id');

            $table->timestamps();

            $table->foreign('auther_id')->references('id')->on('authers')->cascadeOnDelete();
            
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_auther');
    }
};
