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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->boolean('status');
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('author');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author')->references('id')->on('users');
            $table->foreign('category')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
