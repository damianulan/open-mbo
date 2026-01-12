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
        Schema::create('system_notifications', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('notification_id');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->morphs('notifiable');
            $table->json('resources')->nullable();
            $table->longText('contents');

            $table->timestamp('read_at')->nullable();
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_notifications');
    }
};
