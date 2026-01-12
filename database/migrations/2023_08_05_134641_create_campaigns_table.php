<?php

use App\Enums\MBO\CampaignStage;
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
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('period');
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

            $table->enum('stage', CampaignStage::hardValues())->default(CampaignStage::PENDING)->index()->comment('Campaign current status whether in progress, pending, completed, terminated or canceled');

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
