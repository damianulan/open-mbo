<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objective_templates', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('category_id')->nullable()->constrained('objective_template_categories')->cascadeOnDelete();

            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('award', 8, 2)->nullable()->comment('Max points to be awarded for objective completion');

            $table->boolean('draft')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objective_templates');
    }
};
