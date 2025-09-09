<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('category_id')->nullable();
            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('author')->nullable();
            $table->text('content_id')->nullable();
            $table->text('content_en')->nullable();
            $table->string('slug_id')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('document_id')->nullable();
            $table->string('document_en')->nullable();
            $table->string('status')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
