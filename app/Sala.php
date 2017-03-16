<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = ['id','campus_id','tipo_sala_id','nombre','descripcion','capacidad','estado','semestre','anio'];
}
