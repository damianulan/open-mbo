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
        Schema::create('user_bonus_schemes', function (Blueprint $table) {
            $table->char('user_id');
            $table->char('bonus_scheme_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bonus_scheme_id')->references('id')->on('bonus_schemes')->onDelete('cascade');

            $table->primary(['user_id','bonus_scheme_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bonus_schemes');
    }
};
