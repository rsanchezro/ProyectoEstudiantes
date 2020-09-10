<?php
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Asignatura;
use Illuminate\Support\Facades\Route;
function mostrar_estudiantes($estudiantes)
{  echo "<h1 align='center'>LISTADO DE ESTUDIANTES</h1>";
    if($estudiantes->count()>0)
    {
    $campos=array_keys(($estudiantes->toArray())[0]);
  
    echo "<table border='1'><tr>";
    foreach($campos as $campo)
    {
        echo "<td>$campo</td>";
    }
    echo "<td>ASIGNATURAS</td>";
    echo "<td>OPERACION</td>";
    echo "</tr>";

    foreach($estudiantes as $e)
    {
      
        echo "<tr>";
        echo "<td>$e->id</td>
        <td>$e->Nombre</td><td>$e->PrimerApellido</td>
        <td>$e->SegundoApellido</td>
        <td>$e->Telfijo</td>
        <td>$e->Telmovil</td>
        <td>$e->Email</td>
        <td>$e->FechaNacimiento</td>
        <td>$e->Carrera</td>
        <td>$e->Nota</td>
        <td><a href='/estudiantes/".$e->id."'>Asignaturas</a></td>
        <td>$e->created_at</td>
        <td>$e->update_at</td>
        <td><a href='borrarestudiante/$e->id'>Eliminar</a></td>
        echo </tr>";
    }
    echo "</table>";
}
else
{
echo "<h2>NO HAY DATOS</h2>";
}
}
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//OBTENER TODOS LOS CURSOS
Route::get("/cursos",function(){
      $cursos=Curso::all();
      echo "<h1>TODOS LOS CURSOS</h1>";
      echo "<table><tr><td>Nombre</td><td>Descripcion</td><td>Asignaturas</td></tr>";
      foreach($cursos as $curso)
      {
          echo "<tr><td>$curso->Nombre</td><td>$curso->Descripcion</td><td><a href='asignaturas/".$curso->id."'>Asignaturas</a></td></tr>";
      }
      echo "</table>";


});

//OBTENER LAS ASIGNATURAS DE UN CURSO
Route::get("/asignaturas/{idcurso}",function($idcurso){
    $asigs = Curso::find($idcurso)->asignatura;
    echo "<h1>ASIGNATURAS DEL CURSO ".Curso::find($idcurso)->Nombre."</h1>";
    echo "<table><tr><td>Nombre</td><td>Descripcion</td></tr>";

foreach ($asigs as $a) {
    echo "<tr><td>$a->Nombre</td><td>$a->Descripcion</td></tr>";
}
echo "</table>";
});
/* TODOS LOS ALUMNOS */
Route::prefix("estudiantes")->group(function(){
    Route::get("todos",function(){
            $estudiantes=Estudiante::all();
           mostrar_estudiantes($estudiantes);


        
    });
    Route::get("/asignaturas/{id_alumno}",function($id_alumno){
        $estudiantes=Asignatura::find($id_alumno)->get_alumnos;
        mostrar_estudiantes($estudiantes);

    });
    Route::get("/{id_alumno}",function($id_alumno){
        $asignaturas=Estudiante::find($id_alumno)->get_asignaturas;
        echo "<h1 align='center'>LISTADO DE ASIGNATURAS DEL ESTUDIANTE ".Estudiante::find($id_alumno)->Nombre."</h1>";
        echo "<table><tr><td>Nombre</td><td>Alumnos</td></tr>";
        foreach($asignaturas as $a)
        {
        echo "<tr><td>$a->Nombre</td><td><a href='/estudiantes/asignaturas/".$a->id."'>Alumnos</a></td></tr>";
        }
        echo "</table>";

    });
    Route::get("carreras",function()
    {
        $carreras=Estudiante::select('Carrera')->distinct()->get();
        echo "<h1 align='center'>LISTADO DE CARRERAS</h1>";
        foreach($carreras as $c)
        {
            echo $c->Carrera."<br>";
        }
    });

    //Solo x filas
    Route::get("numfilas/{num}",function($num){
        $estudiantes=Estudiante::limit($num)->get();
        mostrar_estudiantes($estudiantes);
});

Route::get("pornotamayor/{nota}",function($nota){
    $e=Estudiante::where("Nota",">",$nota)->get();
    mostrar_estudiantes($e);

});

Route::get("insertar",function(){
$e=new Estudiante;
 $e->id=null;
 $e->Nombre="Pepito";
 $e->PrimerApellido="Sanchez";
 $e->SegundoApellido="de la Rosa";
 $e->Telfijo=32323;
 $e->Telmovil=332232;
 $e->FechaNacimiento="2000-1-1";
 $e->Carrera="Informatica";
 $e->Nota=4;
 $e->save();
});
Route::get("borrarestudiante/{id}",function($id){
    $e=Estudiante::find($id);
    if($e)
    {
        $e->delete();
        echo "Estudiante borrado";
    }
    else{
        echo "Ese estudiante no existe";
    }
});

Route::get("cambiartelefono/{id}/{telefono}",function($id,$telefono){


    $e=Estudiante::where('id', $id)->get();
  
    if($e->count()!=0)
    {
      
        Estudiante::where('id',$id)->update(['Telfijo'=>$telefono]);
        echo "Se actualizo el telefono del estudiante ". $e[0]->Nombre . " ".$e[0]->PrimerApellido;
        
    }
    else
    {
        echo "ESTUDIANTE NO ENCONTRADO";
    }
    
});

    Route::get("",function()
    {
        return "Borrado de usuarios";
    });

});

