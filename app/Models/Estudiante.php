<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public function get_asignaturas()
    {
        return $this->belongsToMany('App\Models\Asignatura','alumno__asignaturas','id_asignatura','id_alumno');
    }
}
