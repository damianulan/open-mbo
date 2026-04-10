<?php

use App\Enums\Users\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('auth')->default('manual');
            $table->encryptable('email');
            $table->encryptable('firstname');
            $table->encryptable('lastname');
            $table->encryptable('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', [
                Gender::MALE->value,
                Gender::FEMALE->value,
                Gender::OTHER->value,
            ])->nullable();
            $table->boolean('core')->default(0)->comment('Core user - comes as default with the application - cannot be deleted');
            $table->boolean('force_password_change')->default(1)->comment('Force user to change password after first login');
            $table->rememberToken();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
