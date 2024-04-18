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
        Schema::create('objective_templates_campaigns', function (Blueprint $table) {
            $table->foreignUuid('objective_template_id');
            $table->foreignUuid('campaign_id');

            $table->foreign('objective_template_id')->references('id')->on('objective_templates')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->primary(['objective_template_id','campaign_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objective_templates_campaings');
    }
};
