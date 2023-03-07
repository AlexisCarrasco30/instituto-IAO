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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->string('localidad');
            $table->string('tipo');
            $table->string('estado');
            $table->foreignId('idUsuario')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idClasificacion')->nullable()->constrained('clasificacion_alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idTutor')->nullable()->constrained('tutores')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
