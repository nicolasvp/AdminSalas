<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table = 'escuelas';

    protected $fillable = ['id','nombre','departamento_id','descripcion'];
}
