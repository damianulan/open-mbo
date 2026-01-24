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
        Schema::create('search_indexes', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->uuidMorphs('source');
            $table->string('attribute');
            $table->string('trigram');
            $table->timestamps();

            $table->index('trigram');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_indexes');
    }
};
