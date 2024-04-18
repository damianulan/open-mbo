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
        Schema::create('user_employments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('foreign_id')->nullable();
            $table->foreignUuid('user_id');
            $table->foreignUuid('company_id');
            $table->foreignUuid('contract_id');
            $table->foreignUuid('department_id');
            $table->foreignUuid('position_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('contract_id')->references('id')->on('type_of_contracts');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('position_id')->references('id')->on('positions');

            $table->date('employment');
            $table->date('release')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_employments');
    }
};
