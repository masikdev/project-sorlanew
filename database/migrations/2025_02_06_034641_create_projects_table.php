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
        Schema::create('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('id_project')->autoIncrement();
            // Project Name with multi-language
            $table->string('project_name_en');
            $table->string('project_name_it')->nullable();
            $table->string('project_name_id')->nullable();
            // Description with multi-language
            $table->longText('description_en');
            $table->longText('description_it')->nullable();
            $table->longText('description_id')->nullable();
            // Location name with multi-language
            $table->string('location_en');
            $table->string('location_it')->nullable();
            $table->string('location_id')->nullable();
            $table->year('year');
            // Category with multi-language
            $table->string('category_en');
            $table->string('category_it')->nullable();
            $table->string('category_id')->nullable();
            // Size with multi-language
            $table->string('size_en');
            $table->string('size_it')->nullable();
            $table->string('size_id')->nullable();
            // Status with multi-language
            $table->string('status_en');
            $table->string('status_it')->nullable();
            $table->string('status_id')->nullable();

            $table->string('designer')->nullable();
            $table->string('client')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
