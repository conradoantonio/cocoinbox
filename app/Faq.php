<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Faq extends Model
{
    /**
     * El nombre de la tabla usada por el modelo.
     *
     * @var string
     */
    protected $table = 'preguntas_frecuentes';

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['tipo_pregunta_id', 'pregunta', 'respuesta', 'imagen'];

    /**
     * Los atributos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Retorna la lista de preguntas junto con su categoría.
     *
     * @var array
     */
    public static function preguntas_detalles()
    {
        return Faq::select(DB::raw('preguntas_frecuentes.*, tipo_pregunta.tipo'))
        ->leftJoin('tipo_pregunta', 'preguntas_frecuentes.tipo_pregunta_id','=', 'tipo_pregunta.id')
        ->get();
    }

    /**
     * Retorna la lista de categorías de preguntas, junto con su respectivo arreglo de preguntas pertenecientes.
     *
     * @var array
     */
    public static function faqs_detalles()
    {
        $preguntas_categoria = TipoPregunta::select(DB::raw('id, tipo AS categoria'))->get();
        foreach ($preguntas_categoria as $faq) {
            $faq->preguntas = Faq::where('tipo_pregunta_id', $faq->id)->get();
        }
        return $preguntas_categoria;
    }
}
