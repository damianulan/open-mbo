<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MBO\CampaignStage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('period')->unique();
            $table->longText('description')->nullable();

            $table->dateTime(CampaignStage::DEFINITION . '_from')->nullable();
            $table->dateTime(CampaignStage::DEFINITION . '_to')->nullable();

            $table->dateTime(CampaignStage::DISPOSITION . '_from')->nullable();
            $table->dateTime(CampaignStage::DISPOSITION . '_to')->nullable();

            $table->dateTime(CampaignStage::REALIZATION . '_from')->nullable();
            $table->dateTime(CampaignStage::REALIZATION . '_to')->nullable();

            $table->dateTime(CampaignStage::EVALUATION . '_from')->nullable();
            $table->dateTime(CampaignStage::EVALUATION . '_to')->nullable();

            $table->dateTime(CampaignStage::SELF_EVALUATION . '_from')->nullable();
            $table->dateTime(CampaignStage::SELF_EVALUATION . '_to')->nullable();

            $table->enum('stage', CampaignStage::hardValues())->default(CampaignStage::PENDING);

            $table->boolean('draft')->default(1);
            $table->boolean('manual')->default(0); // if on - do not automatically end stage after date passes

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
