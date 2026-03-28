<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bonus_schemes', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->longText('description')->nullable();

            $table->json('options');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bonus_schemes');
    }
};
