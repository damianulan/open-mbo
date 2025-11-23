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
        Schema::create('departments', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('parent_id')->nullable();
            $table->string('name', 255);
            $table->longText('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
