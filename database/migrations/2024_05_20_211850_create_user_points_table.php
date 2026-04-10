<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_points', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('subject');

            $table->decimal('points', 8, 2)->nullable();

            $table->foreignId('assigned_by')->nullable()->constrained('users')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
            $table->comment('Points assigned to users. Subject describes the entity from which the points were assigned.');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};
