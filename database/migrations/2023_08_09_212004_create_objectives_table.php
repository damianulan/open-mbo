<?php

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
        Schema::create('objectives', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('template_id')->nullable();
            // although template is being assigned to a campaign, template can still be deleted, but a connection between objective and campaign (if made) must stand.
            // connection is nullable because objective can be assigned not necessarily by a campaign assignment
            $table->foreignUuid('campaign_id')->nullable();

            $table->foreign('template_id')->references('id')->on('objective_templates')->nullOnDelete();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->string('name', 255);
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable()->comment('Deadline for objective completion, to which realization should be approved, otherwise it turns out red.');
            $table->decimal('weight', 8, 2)->default(1)->comment('Corresponds to the importance of the objective, the higher the weight, the more important it is.');
            $table->decimal('award', 8, 2)->nullable()->comment('Max points to be awarded for objective completion');
            $table->decimal('expected', 8, 2)->nullable()->comment('Expected numerical value of objective realization, that corresponds to 100% evaluation');

            $table->boolean('draft')->default(1)->comment('Is not visible to realization - only previewable to admins'); // it's a draft on the assignment and can be adjusted in another view.
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
