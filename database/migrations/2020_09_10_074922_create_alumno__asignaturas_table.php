<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno__asignaturas', function (Blueprint $table) {
           $table->bigInteger('id_alumno')->unsigned();
           $table->bigInteger('id_asignatura')->unsigned();
           $table->smallInteger("anno")->unsigned();
           $table->smallInteger("nota")->unsigned();
           $table->primary(['id_alumno','id_asignatura']);
           $table->foreign("id_alumno")->references('id')->on('estudiantes');
           $table->foreign("id_asignatura")->references('id')->on('asignaturas');
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
        Schema::dropIfExists('alumno__asignaturas');
    }
}
