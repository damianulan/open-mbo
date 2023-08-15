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
            // although template is being assigned to a campaign, template can still be deleted, but a connection between objective and campaign (if made) must stand.
            // connection is nullable because objective can be assigned not necessarily by a campaign assignment
            $table->char('campaign_id')->nullable();

            $table->foreign('template_id')->references('id')->on('objective_templates')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaign')->onDelete('cascade');

            $table->char('user_id');
            $table->string('name');
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable();
            $table->float('goal')->nullable();

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
