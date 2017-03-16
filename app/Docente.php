<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';

    protected $fillable = ['id','departamento_id','rut','nombres','apellidos','email'];
}
