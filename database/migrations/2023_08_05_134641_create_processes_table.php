<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ProcessStage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('period')->unique();
            $table->string('stage'); // process can be reverted or fast-forwarded regardless of dates
            $table->longText('description')->nullable();

            $table->date(ProcessStage::DEFINITION->value.'_from');
            $table->date(ProcessStage::DEFINITION->value.'_to');

            $table->date(ProcessStage::DISPOSITION->value.'_from');
            $table->date(ProcessStage::DISPOSITION->value.'_to');

            $table->date(ProcessStage::REALIZATION->value.'_from');
            $table->date(ProcessStage::REALIZATION->value.'_to');

            $table->date(ProcessStage::EVALUATION->value.'_from');
            $table->date(ProcessStage::EVALUATION->value.'_to');

            $table->date(ProcessStage::SELF_EVALUATION->value.'_from');
            $table->date(ProcessStage::SELF_EVALUATION->value.'_to');

            $table->boolean('draft')->default(1);
            $table->boolean('manual')->default(0); // if on - do not automatically end stage after date passes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
