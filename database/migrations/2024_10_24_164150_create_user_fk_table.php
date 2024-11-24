<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->foreign('fiscalia_fk')->references('id')->on('fiscalia');
            $table->foreign('roles_fk')->references('id')->on('user_roles');
            //$table->foreign('session_fk')->references('id')->on('sesion_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['fiscalia_fk']);
            $table->dropForeign(['roles_fk']);
            //$table->dropForeign(['session_fk']);
        });
    }
};
