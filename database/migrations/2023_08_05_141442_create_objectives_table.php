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
        Schema::create('objectives', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('parent_id')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();

            $table->string('min_goal')->nullable();
            $table->string('expected_goal')->nullable();
            $table->string('max_goal')->nullable();

            $table->string('type');
            $table->boolean('draft')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
