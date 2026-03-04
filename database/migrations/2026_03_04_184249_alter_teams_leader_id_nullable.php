<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table): void {
            $table->dropForeign(['leader_id']);
            $table->foreignUuid('leader_id')->nullable()->change();
            $table->foreign('leader_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table): void {
            $table->dropForeign(['leader_id']);
            $table->foreignUuid('leader_id')->nullable(false)->change();
            $table->foreign('leader_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
