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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categor_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->string('title');
            $table->string('isbn')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('publish_year')->nullable();
            $table->unsignedBigInteger("number_of_page")->nullable();
            $table->unsignedBigInteger("number_of_copy")->nullable();
            $table->decimal('price' , 8 , 2);
            $table->string('cover_image');
            $table->timestamps();



            $table->foreign('categor_id')
            ->references('id')
            ->on('categor')
            ->onDelete('set null');


            $table->foreign('publisher_id')
            ->references('id')
            ->on('publisher')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
