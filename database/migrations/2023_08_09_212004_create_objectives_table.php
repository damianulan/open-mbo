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
            $table->foreignUuid('template_id')->nullable();
            $table->foreignUuid('parent_id')->nullable();
            // although template is being assigned to a campaign, template can still be deleted, but a connection between objective and campaign (if made) must stand.
            // connection is nullable because objective can be assigned not necessarily by a campaign assignment
            $table->foreignUuid('campaign_id')->nullable();
            $table->foreignUuid('user_id');

            $table->foreign('template_id')->references('id')->on('objective_templates')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->string('name');
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable();
            $table->decimal('goal', 8,2)->nullable();
            $table->decimal('weight', 8,2)->default(1);
            $table->decimal('award', 8,2)->nullable();

            $table->boolean('draft')->default(1); // it's a draft on the assignment and can be adjusted in another view.
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
