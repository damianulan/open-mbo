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
        Schema::create('user_processes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('process_id');
            $table->char('user_id');
            $table->string('stage'); // user assignment can be reverted or fast-forwarded regardless of process stage

            $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('manual')->default(0); // user assignment can be hold for extended period without 
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_processes');
    }
};
