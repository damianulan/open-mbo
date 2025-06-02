<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->uuidMorphs('model', 'model');

            $table->foreignUuid('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->uuidMorphs('context', 'context');

            $table->primary(['model_type', 'model_id', 'role_id', 'context_type', 'context_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_roles');
    }
};
