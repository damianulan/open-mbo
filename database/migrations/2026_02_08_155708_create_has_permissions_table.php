<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('has_permissions', function (Blueprint $table): void {
            $table->uuidMorphs('model');
            $table->foreignId('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->primary(['model_type', 'model_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('has_permissions');
    }
};
