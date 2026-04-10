<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table): void {
            $table->id();
            $table->string('key', 255)->unique();
            $table->json('contents')->nullable();
            $table->boolean('system')->default(true);
            $table->boolean('email')->default(true);
            $table->string('event', 255)->nullable()->index();
            $table->string('schedule')->nullable();
            $table->json('conditions')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
