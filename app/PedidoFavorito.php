<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoFavorito extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'pedido_favoritos';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = [
    	'servicio_id', 'usuario_id'
    ];

    /**
     * Desactiva el uso de los campos timestamp.
     */
    public $timestamps = false;

    /**
     * Obtiene el pedido al que pertenece un detalle
     */
    public function pedido()
    {
        return $this->belongsTo('App\Servicio', 'servicio_id');
    }

    /**
     * Obtiene los detalles de un pedido.
     */
    public function detalles()
    { 
        return $this->hasMany('App\FavoritoDetalle', 'pedido_favorito_id', 'id');
    }
}
