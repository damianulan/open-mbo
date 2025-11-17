<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datatables_columns_selected', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->foreignUuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('table_id', 255);
            $table->json('columns');
            $table->json('selected');
            $table->timestamps();

            $table->comment('From all datatables custom preferences on columns selected as visible to specific user.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datatables_columns_selected');
    }
};
