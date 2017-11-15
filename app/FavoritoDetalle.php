<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoritoDetalle extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'favoritos_detalles';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = [
    	'pedido_favorito_id', 'producto_id', 'cantidad', 'porciones_adicionales', 'medida_bebida'
    ];

    /**
     * Desactiva el uso de los campos timestamp.
     */
    public $timestamps = false;

    /**
     * Obtiene los detalles de un pedido.
     */
    public function detalles()
    {
        return $this->belongsTo('App\PedidoFavorito', 'pedido_favorito_id');
    }
}
