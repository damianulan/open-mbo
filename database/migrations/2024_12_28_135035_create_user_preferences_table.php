<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('lang', 4)->default('auto');
            $table->string('theme', 128);
            $table->string('mail_notifications', 1);
            $table->string('app_notifications', 1);
            $table->string('extended_notifications', 1);
            $table->string('system_notifications', 1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
