<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = ['id','asignatura_id','docente_id','semestre','anio','seccion'];
}
