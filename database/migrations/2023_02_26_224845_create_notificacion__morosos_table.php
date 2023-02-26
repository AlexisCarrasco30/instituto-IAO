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
        Schema::create('notificacion_morosos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->date('fecha');
            $table->string('estado');
            $table->string('mensaje');
            $table->foreignId('idPersona')->nullable()->constrained('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idMoroso')->nullable()->constrained('morosos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('notificacion_morosos');
    }
};
