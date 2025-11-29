<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('objective_templates', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('objective_template_categories')->onDelete('cascade');

            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('award', 8, 2)->nullable()->comment('Max points to be awarded for objective completion');

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
