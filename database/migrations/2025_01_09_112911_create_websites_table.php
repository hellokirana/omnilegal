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
        Schema::create('websites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url')->nullable();
            $table->string('nama')->nullable();
            $table->string('caption')->nullable();

            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();

            $table->text('maps')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->text('address_id')->nullable();
            $table->text('address_en')->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('x')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
