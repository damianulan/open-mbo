<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ObjectiveType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('objective_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();

            $table->foreign('category_id')->references('id')->on('objective_template_categories')->onDelete('cascade');

            $table->decimal('goal', 8,2)->nullable();

            $table->enum('type', [
                ObjectiveType::INDIVIDUAL->value,
                ObjectiveType::TEAM->value,
                ObjectiveType::GLOBAL->value
            ]);

            $table->unsignedSmallInteger('award')->nullable();

            $table->boolean('draft')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objective_templates');
    }
};
