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
            $table->string('project_name_it');
            $table->string('project_name_id');
            // Description with multi-language
            $table->longText('description_en');
            $table->longText('description_it');
            $table->longText('description_id');
            // Location name with multi-language
            $table->string('location_en');
            $table->string('location_it');
            $table->string('location_id');
            $table->date('year');
            // Category with multi-language
            $table->enum('category_en', ['architecture', 'interior', 'foundation projects', 'building performance']);
            $table->enum('category_it', ['architettura', 'interna', 'progetti di fondazione', "prestazioni dell\'edificio"]);
            $table->enum('category_id', ['arsitektur', 'interior', 'proyek pondasi', 'kinerja bangunan']);
            // Size with multi-language
            $table->string('size_en');
            $table->string('size_it');
            $table->string('size_id');
            // Status with multi-language
            $table->string('status_en');
            $table->string('status_it');
            $table->string('status_id');
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
