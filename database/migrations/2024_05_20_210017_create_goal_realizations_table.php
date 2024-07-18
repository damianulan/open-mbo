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
        Schema::create('goal_realizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_objective_id');
            $table->foreignUuid('objective_goal_id');

            $table->foreign('user_objective_id')->references('id')->on('user_objectives')->onDelete('cascade');
            $table->foreign('objective_goal_id')->references('id')->on('objective_goals')->onDelete('cascade');
            $table->datetime('completed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_realizations');
    }
};
