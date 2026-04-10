<?php

use App\Enums\Mbo\UserObjectiveStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_objectives', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('objective_id')->constrained('objectives')->cascadeOnDelete();

            $table->enum('status', UserObjectiveStatus::values())->default(UserObjectiveStatus::UNSTARTED->value)->index()->comment('objective status');
            $table->decimal('realization', 8, 2)->nullable()->comment('Numerical value of the realization of the objective - in relation to the expected value in objective');
            $table->decimal('evaluation', 8, 2)->nullable()->comment('Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically');

            $table->timestamp('evaluated_at')->nullable()->comment('Time when most recent evaluation was made');
            $table->foreignId('evaluated_by')->nullable()->comment('Time when most recent evaluator has made any changes')->constrained('users');

            $table->decimal('self_realization', 8, 2)->nullable()->comment('Numerical value of the realization of the objective - in relation to the expected value in objective');
            $table->decimal('self_evaluation', 8, 2)->nullable()->comment('Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically');
            $table->timestamp('self_evaluated_at')->nullable()->comment('Time when most recent self evaluation was made');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_objectives');
    }
};
