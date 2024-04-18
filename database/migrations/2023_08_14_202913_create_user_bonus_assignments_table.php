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
        Schema::create('user_bonus_assignments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id');
            $table->foreignUuid('bonus_scheme_id');
            $table->foreignUuid('campaign_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bonus_scheme_id')->references('id')->on('bonus_schemes')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->tinyInteger('score')->unsigned(); // in percent

            $table->foreignUuid('approved_by');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bonus_assignments');
    }
};
