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
            $table->char('user_id');
            $table->char('company_id');
            $table->char('contract_id');
            $table->char('department_id');
            $table->char('position_id');

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
