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
        Schema::create('objective_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->longText('description')->nullable();

            $table->string('min_goal')->nullable();
            $table->integer('min_goal_weight')->default(80);
            $table->string('exp_goal')->nullable();
            $table->integer('exp_goal_weight')->default(100);
            $table->string('max_goal')->nullable();
            $table->integer('max_goal_weight')->default(120);

            $table->string('type'); // App\Enums\ObjectiveType::enum
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
        Schema::dropIfExists('objective_templates');
    }
};
