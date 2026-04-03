<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_employments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('contract_id')->nullable()->constrained('type_of_contracts');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('position_id')->nullable()->constrained('positions');

            $table->date('employment')->nullable()->comment('Date of employment');
            $table->date('release')->nullable()->comment('Date of employee release (end of employment)');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_employments');
    }
};
