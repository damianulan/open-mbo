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

            $table->dateTime(CampaignStage::DEFINITION->value.'_from');
            $table->dateTime(CampaignStage::DEFINITION->value.'_to');

            $table->dateTime(CampaignStage::DISPOSITION->value.'_from');
            $table->dateTime(CampaignStage::DISPOSITION->value.'_to');

            $table->dateTime(CampaignStage::REALIZATION->value.'_from');
            $table->dateTime(CampaignStage::REALIZATION->value.'_to');

            $table->dateTime(CampaignStage::EVALUATION->value.'_from');
            $table->dateTime(CampaignStage::EVALUATION->value.'_to');

            $table->dateTime(CampaignStage::SELF_EVALUATION->value.'_from');
            $table->dateTime(CampaignStage::SELF_EVALUATION->value.'_to');

            $table->enum('stage', CampaignStage::hardValues());

            $table->boolean('draft')->default(1);
            $table->boolean('manual')->default(0); // if on - do not automatically end stage after date passes

            $table->foreignUuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

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
