<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = ['fecha','sala_id','periodo_id','curso_id','permanencia','dia'];
}
