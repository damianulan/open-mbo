<?php

use App\Enums\MBO\CampaignStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_campaigns', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('campaign_id');
            $table->foreignUuid('user_id');
            $table->enum('stage', CampaignStage::values())->default(CampaignStage::PENDING)->index()->comment('User current campaign stage');

            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('manual')->default(0)->comment('User will not be automatically moved between stages.'); // user assignment can be held for extended period without
            $table->boolean('active')->default(1)->comment('Is visible to users.');
            $table->softDeletes();
            $table->timestamps();
            $table->comment('Users assigned to campaigns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_campaigns');
    }
};
