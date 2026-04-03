<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objectives', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('template_id')->nullable()->constrained('objective_templates')->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->cascadeOnDelete();

            $table->string('name', 255);
            $table->longText('description')->nullable();

            $table->dateTime('deadline')->nullable()->comment('Deadline for objective completion, to which realization should be approved, otherwise it turns out red.');
            $table->decimal('weight', 8, 2)->default(1)->comment('Corresponds to the importance of the objective, the higher the weight, the more important it is.');
            $table->decimal('award', 8, 2)->nullable()->comment('Max points to be awarded for objective completion');
            $table->decimal('expected', 8, 2)->nullable()->comment('Expected numerical value of objective realization, that corresponds to 100% evaluation');

            $table->boolean('draft')->default(1)->comment('Is not visible to realization - only previewable to admins');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
