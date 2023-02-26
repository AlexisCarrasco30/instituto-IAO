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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->binary('archivo');
            $table->string('tipo');
            $table->boolean('estado');
            $table->foreignId('idProfesion')->nullable()->constrained('profesiones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idMateria')->nullable()->constrained('materias')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};
