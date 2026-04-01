<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favourities', function (Blueprint $table): void {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->morphs('subject');

            $table->unique(['user_id', 'subject_id', 'subject_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourities');
    }
};
