<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSala extends Model
{
    protected $table = 'tipos_salas';

    protected $fillable = ['id','nombre','descripcion'];
}
