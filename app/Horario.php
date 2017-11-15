<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'horarios';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = [
    	'hora_inicio', 'hora_fin', 'dia', 'created_at'
    ];
}
