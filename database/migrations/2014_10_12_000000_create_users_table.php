<?php

use App\Enums\Users\Gender;
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
        Schema::create('users', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('auth')->default('manual');
            $table->string('email')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', [
                Gender::MALE,
                Gender::FEMALE,
                Gender::OTHER,
            ])->nullable();
            $table->boolean('core')->default(0)->comment('Core user - comes as default with the application - cannot be deleted');
            $table->boolean('force_password_change')->default(1)->comment('Force user to change password after first login'); // 0 - blocked, 1 - active
            $table->rememberToken();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
