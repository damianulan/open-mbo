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
            $table->char('template_id')->nullable();
            $table->char('parent_id')->nullable();
            $table->char('user_id');
            $table->string('name');
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable();
            $table->string('min_goal')->nullable();
            $table->string('exp_goal')->nullable();
            $table->string('max_goal')->nullable();

            $table->foreign('template_id')->references('id')->on('objective_templates')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('draft')->default(1);
            $table->boolean('of_campaign')->default(0); // was assigned with campaign assignment
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
