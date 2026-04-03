<?php

use App\Enums\Mbo\CampaignStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_campaigns', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('stage', CampaignStage::values())->default(CampaignStage::PENDING->value)->index()->comment('User current campaign stage');

            $table->boolean('manual')->default(0)->comment('User will not be automatically moved between stages.');
            $table->boolean('active')->default(1)->comment('Is visible to users.');
            $table->softDeletes();
            $table->timestamps();
            $table->comment('Users assigned to campaigns');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_campaigns');
    }
};
