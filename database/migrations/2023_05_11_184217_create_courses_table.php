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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('category_id');
            $table->foreign('category_id')->references('id')->on('course_categories')->onDelete('cascade');
            $table->string('title', 128);
            $table->longText('description')->nullable();

            $table->timestamp('available_from')->nullable();
            $table->timestamp('available_to')->nullable();
            $table->boolean('public')->default(1);
            $table->boolean('active')->default(1);
            $table->boolean('visible')->default(1);
            $table->string('picture')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
