<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas';

    protected $fillable = ['departamento_id','codigo','nombre','descripcion'];
}
