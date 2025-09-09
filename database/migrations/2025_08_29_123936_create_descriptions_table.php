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
        Schema::create('descriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->longText('about_id')->nullable();
            $table->longText('about_en')->nullable();
            $table->text('short_about_id')->nullable();
            $table->text('short_about_en')->nullable();

            $table->longText('team_id')->nullable();
            $table->longText('team_en')->nullable();

            $table->longText('career_id')->nullable();
            $table->longText('career_en')->nullable();

            $table->longText('service_id')->nullable();
            $table->longText('service_en')->nullable();

            $table->longText('practice_id')->nullable();
            $table->longText('practice_en')->nullable();

            $table->longText('disclaimer_id')->nullable();
            $table->longText('disclaimer_en')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
