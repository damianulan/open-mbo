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
        Schema::create('campaign_objectives', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('campaign_id');
            $table->char('template_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('objective_templates')->nullOnDelete();

            $table->string('name');
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable();
            $table->float('goal')->nullable();
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
        Schema::dropIfExists('campaign_objectives');
    }
};
