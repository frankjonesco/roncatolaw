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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11);
            $table->foreignId('user_id')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('title');
            $table->text('caption')->nullable();
            $table->string('image')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('image_copyright')->nullable();
            $table->integer('views')->nullable();
            $table->timestamps();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
