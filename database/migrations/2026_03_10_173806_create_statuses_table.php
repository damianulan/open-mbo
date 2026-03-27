<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('name');
            $table->text('reason')->nullable();
            $table->uuidMorphs('model');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
}
