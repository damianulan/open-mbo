<?php

use App\Enums\MBO\UserObjectiveStatus;
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
        Schema::create('user_objectives', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->foreignUuid('objective_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade');

            $table->enum('status', UserObjectiveStatus::values())->default(UserObjectiveStatus::UNSTARTED)->index()->comment('objective status');
            $table->decimal('realization', 8, 2)->nullable()->comment('Numerical value of the realization of the objective - in relation to the expected value in objective');
            $table->decimal('evaluation', 8, 2)->nullable()->comment('Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically');

            $table->timestamp('evaluated_at')->nullable()->comment('Time when most recent evaluation was made');
            $table->foreignUuid('evaluated_by')->nullable()->comment('Time when most recent evaluator has made any changes');
            $table->foreign('evaluated_by')->references('id')->on('users');

            $table->decimal('self_realization', 8, 2)->nullable()->comment('Numerical value of the realization of the objective - in relation to the expected value in objective');
            $table->decimal('self_evaluation', 8, 2)->nullable()->comment('Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically');
            $table->timestamp('self_evaluated_at')->nullable()->comment('Time when most recent self evaluation was made');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_objectives');
    }
};
