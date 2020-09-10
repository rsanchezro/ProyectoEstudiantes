<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { /*
        Identificador (será la clave primaria) Nombre
Primer Apellido

Segundo Apellido Teléfono fijo Teléfono móvil
e-mail

Fecha nacimiento Carrera
Nota

Elija el tipo de dato que considere más adecuado para cada campo.
*/
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre");
            $table->string("PrimerApellido");
            $table->string("SegundoApellido");
            $table->bigInteger('Telfijo')->unsigned()->nullable();
            $table->bigInteger('Telmovil')->unsigned()->nullable();
            $table->string('Email')->nullable();
            $table->date("FechaNacimiento");
            $table->string("Carrera");
            $table->smallInteger('Nota')->unsigned();
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
        Schema::dropIfExists('estudiantes');
    }
}
