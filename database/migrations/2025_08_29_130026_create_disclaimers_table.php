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
        Schema::create('disclaimers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('description_id')->nullable();
            $table->longText('description_en')->nullable();
            $table->dateTime('last_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disclaimers');
    }
};
