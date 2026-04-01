<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datatables_columns_selected', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('table_id', 255);
            $table->json('columns');
            $table->json('selected');
            $table->timestamps();

            $table->comment('From all datatables custom preferences on columns selected as visible to specific user.');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datatables_columns_selected');
    }
};
