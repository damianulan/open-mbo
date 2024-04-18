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
        Schema::create('objective_evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('objective_id')->nullable();
            $table->foreign('objective_id')->references('id')->on('objectives')->nullOnDelete();

            $table->decimal('evaluation', 8,2);
            $table->string('comment', 300);
            $table->foreignUuid('evaluated_by');
            $table->foreign('evaluated_by')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objective_evaluations');
    }
};
