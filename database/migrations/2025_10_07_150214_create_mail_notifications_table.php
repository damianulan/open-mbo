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
        Schema::create('mail_notifications', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('notification_id');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->morphs('notifiable');
            $table->json('resources')->nullable();
            $table->string('subject', 255);
            $table->longText('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_notifications');
    }
};
