<?php

use App\Enums\Mbo\CampaignStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('period');
            $table->longText('description')->nullable();

            $table->dateTime(CampaignStage::DEFINITION->value . '_from')->nullable();
            $table->dateTime(CampaignStage::DEFINITION->value . '_to')->nullable();

            $table->dateTime(CampaignStage::DISPOSITION->value . '_from')->nullable();
            $table->dateTime(CampaignStage::DISPOSITION->value . '_to')->nullable();

            $table->dateTime(CampaignStage::REALIZATION->value . '_from')->nullable();
            $table->dateTime(CampaignStage::REALIZATION->value . '_to')->nullable();

            $table->dateTime(CampaignStage::EVALUATION->value . '_from')->nullable();
            $table->dateTime(CampaignStage::EVALUATION->value . '_to')->nullable();

            $table->dateTime(CampaignStage::SELF_EVALUATION->value . '_from')->nullable();
            $table->dateTime(CampaignStage::SELF_EVALUATION->value . '_to')->nullable();

            $table->enum('stage', CampaignStage::hardValues())->default(CampaignStage::PENDING->value)->index()->comment('Campaign current status whether in progress, pending, completed, terminated or canceled');

            $table->boolean('draft')->default(1)->comment('Visible to admins only and is not automatically published.');
            $table->boolean('manual')->default(0)->comment('Will not be automatically moved between stages.'); // if on - do not automatically end stage after date passes

            $table->timestamps();
            $table->softDeletes();
            $table->comment('MBO Campaigns with users and objectives assigned to it.');
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
