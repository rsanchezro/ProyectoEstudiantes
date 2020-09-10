<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    public function curso(){
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    public function get_alumnos(){
        return $this->belongsToMany('App\Models\Estudiante','alumno__asignaturas','id_alumno','id_asignatura');

    }
}
