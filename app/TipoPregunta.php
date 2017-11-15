<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPregunta extends Model
{
	/**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'tipo_pregunta';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['tipo'];
}
