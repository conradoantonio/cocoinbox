<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Servicio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_cliente', 'correo_cliente', 'conekta_order_id', 'customer_id_conekta', 'costo_total', 'telefono', 'recibidor', 'calle', 
        'num_ext', 'num_int', 'ciudad', 'estado', 'pais', 'codigo_postal', 'latitud', 'longitud', 'comentarios', 'datetime_formated', 
        'repartidor_id', 'activo', 'status', 'tipo_pago', 'is_finished', 'puntuacion', 'codigo_liberacion', 'last_digits', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Obtiene los detalles de un pedido.
     */
    public function detalles()
    {
        return $this->hasMany('App\ServicioDetalle', 'servicio_id', 'id');
    }

    /**
     * Obtiene los detalles de un pedido favorito.
     */
    public function favorito()
    {
        return $this->hasOne('App\PedidoFavorito', 'servicio_id', 'id');
    }

    /**
     * Obtiene todos los pedidos realizados
     *
     * @return $pedidos
     */
    public static function obtener_pedidos($status, $pedido_id = false)
    {
        $query = Servicio::select(DB::raw('servicios.*, usuario.nombre AS cliente_nombre, usuario.apellido AS cliente_apellido, usuario.correo AS cliente_correo, 
            usuario.foto_perfil AS cliente_foto, usuario.celular AS cliente_celular, usuario.customer_id_conekta AS cliente_customer_id_conekta,
            usuario_repartidor.nombre AS repartidor_nombre, usuario_repartidor.apellido AS repartidor_apellido, usuario_repartidor.correo AS repartidor_correo,
            usuario_repartidor.foto_perfil AS repartidor_foto, usuario_repartidor.celular AS repartidor_celular'))
        ->leftJoin('usuario', 'servicios.usuario_id', '=', 'usuario.id')//Usuario cliente
        ->leftJoin('usuario AS usuario_repartidor', 'servicios.repartidor_id', '=', 'usuario_repartidor.id')//Usuario repartidor
        ->where('is_finished', $status)
        ->orderBy('servicios.id', 'DESC');

        if ($pedido_id) {
            $query = $query->where('servicios.id', $pedido_id)->first();
            $query->detalles = ServicioDetalle::where('servicio_id', $pedido_id)->get();
        } else {
            $query = $query->get();
        }
        return $query;
    }
    
    /**
     *
     * @return Regresa el total de serviciosa
     */
    public static function total_servicios()
    {
        return Servicio::count();
    }

    /**
     *
     * @return Regresa el total de ventas filtrados por empresa
     */
    public static function total_vendido()
    {
        return Servicio::where('status', 'paid')
        ->sum(DB::raw('costo_total'));
    }

    /**
     *
     * @return Regresa el total de ventas semanales
     */
    public static function ventas_semanales()
    {
        return Servicio::select(DB::raw('SUBSTRING_INDEX(created_at, " ", 1) as created_at, SUM(costo_total)/100 AS "Costo_total", 
            MONTH(`created_at`) AS Mes, DAY(`created_at`) AS Dia, COUNT(*) AS Total_Ventas'))
        ->where('created_at', '>=', DB::raw('SUBDATE(CURDATE(),INTERVAL 7 DAY)'))
        ->where('created_at', '<', DB::raw('CURDATE()'))
        ->where('status', 'paid')
        ->groupBy(DB::raw('DAY(created_at)'))
        ->get();
    }

    /**
     *
     * @return Regresa el customer_id_conekta de un usuario
     */
    public static function obtener_id_conekta_usuario($usuario_id)
    {
        return DB::table('usuario')->where('id', $usuario_id)->pluck('customer_id_conekta');
    }

    /**
     *
     * @return Regresa los pedidos activos de un usuario cliente
     */
    public static function obtener_pedidos_activos_usuario($usuario_id)
    {
        return Servicio::select(DB::raw('servicios.*, usuario.nombre, usuario.apellido, usuario.foto_perfil'))
        ->where('usuario_id', $usuario_id)
        ->leftJoin('usuario', 'servicios.repartidor_id', '=', 'usuario.id')
        ->where('is_finished', 0)
        ->get();
    }

    /**
     *
     * @return Regresa los pedidos finalizados de un usuario cliente
     */
    public static function obtener_pedidos_finalizados_usuario($usuario_id)
    {
        return Servicio::select(DB::raw('servicios.*, usuario.nombre, usuario.apellido, usuario.foto_perfil'))
        ->where('usuario_id', $usuario_id)
        ->leftJoin('usuario', 'servicios.repartidor_id', '=', 'usuario.id')
        ->where('is_finished', 1)
        ->where('status', 'paid')
        ->get();
    }

    /**
     *
     * @return Regresa los números de guía de los pedidos de un repartidor
     */
    public static function obtener_pedidos_activos_repartidor($repartidor_id)
    {
        return Servicio::select(DB::raw('servicios.*, usuario.foto_perfil'))
        ->where('repartidor_id', $repartidor_id)
        ->leftJoin('usuario', 'servicios.usuario_id', '=', 'usuario.id')
        ->where('is_finished', 0)
        ->get();
    }

    /**
     *
     * @return Regresa los números de guía de los pedidos de un repartidor
     */
    public static function obtener_pedidos_finalizados_repartidor($repartidor_id)
    {
        return Servicio::select(DB::raw('servicios.*, usuario.foto_perfil'))
        ->where('repartidor_id', $repartidor_id)
        ->leftJoin('usuario', 'servicios.usuario_id', '=', 'usuario.id')
        ->where('is_finished', 1)
        ->where('servicios.status', 'paid')
        ->get();
    }

    /**
     *
     * @return Regresa los detalles del pedido, es decir, producto, categoría, porciones, etc.
     */
    public static function detalle_pedido($servicio_id)
    {
        return ServicioDetalle::select(DB::raw('servicio_detalles.*, categorias.categoria'))
        ->leftJoin('categorias', 'servicio_detalles.categoria_id', '=', 'categorias.id')
        ->where('servicio_detalles.servicio_id', $servicio_id)
        ->get();
    }
}
