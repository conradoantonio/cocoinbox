<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioDetalle extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicio_detalles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'servicio_id', 'producto_id', 'nombre_producto', 'foto_producto', 'precio', 'cantidad', 
        'porciones_adicionales', 'precio_porcion', 'peso_porcion', 'drink', 'created_at'
    ];

    /**
     * Obtiene el pedido al que pertenece un detalle
     */
    public function pedido()
    {
        return $this->belongsTo('App\Servicio', 'servicio_id');
    }
}
