<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Repartidor extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'repartidores';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = ['usuario_id', 'comprobante_domicilio', 'licencia', 'solicitud_trabajo', 'credencial_elector', 'created_at'];

    /**
     * Obtiene todos los datos del usuario repartidor.
     */
    public static function repartidor_detalles($usuario_id = false)
    {
    	$query = Repartidor::select(DB::raw('usuario.id AS usuario_id, usuario.nombre, usuario.apellido, usuario.correo, usuario.foto_perfil, usuario.celular, usuario.status,
            repartidores.id AS repartidor_id, comprobante_domicilio, licencia, solicitud_trabajo, credencial_elector'))
    	->leftJoin('usuario', 'repartidores.usuario_id', '=', 'usuario.id')
    	->where('usuario.status', '!=', 2)
    	->where('usuario.tipo', 2);

    	$query = $usuario_id ? $query->where('repartidores.usuario_id', $usuario_id)->first() : $query->get();

    	return $query;
    }

    /**
     * Carga la lista de los repartidores disponibles, en caso de que ya exista un repartidor asignado a un pedido, este será excluido de la lista para ser listado en el select.
     *
     * @return App\Repartidor
     */
    public static function filtrar_repartidores($status, $repartidor_id = false)
    {
        $repartidores = Usuario::where('tipo', 2)->where('status', $status);

        if ($repartidor_id) {
            $repartidores = $repartidores->where('id', '!=', $repartidor_id);
        }
        
        return $repartidores->get();
    }
}
