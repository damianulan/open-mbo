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
        Schema::create('users_supervisors', function (Blueprint $table) {
            $table->char('user_id');
            $table->char('supervisor_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['user_id','supervisor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_supervisors');
    }
};
