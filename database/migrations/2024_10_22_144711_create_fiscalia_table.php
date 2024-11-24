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
        Schema::create('fiscalia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_fis_fk')->nullable();
            $table->unsignedBigInteger('nombre_fis_fk')->nullable();
            $table->unsignedBigInteger('tipo_fk')->nullable();
            $table->unsignedBigInteger('despacho_fk')->nullable();
            $table->string('descripcion')->nullable();

            $table->foreign('area_fis_fk')->references('id')->on('area_fiscalia') ;
            $table->foreign('nombre_fis_fk')->references('id')->on('nombre_fiscalia');
            $table->foreign('tipo_fk')->references('id')->on('tipo_fiscalia');
            $table->foreign('despacho_fk')->references('id')->on('despacho');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscalia');
    }
};
