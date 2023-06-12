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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->char('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->char('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // $table->bigInteger('type_id')->unsigned();
            // $table->foreign('type_id')->references('id')->on('enrollment_types')->onDelete('cascade');

            $table->timestamp('timestart');
            $table->timestamp('timeend')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
