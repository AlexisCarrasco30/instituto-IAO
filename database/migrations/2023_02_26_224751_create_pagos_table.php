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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->float('monto');
            $table->float('deuda');
            $table->date('fecha');
            $table->string('estado');
            $table->foreignId('idMulta')->nullable()->constrained('multas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idAlumno')->nullable()->constrained('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idProfesion')->nullable()->constrained('profesiones')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pagos');
    }
};
