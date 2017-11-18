<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Servicio;
use App\Repartidor;
use App\ServicioDetalle;
use DB;
use PDO;
use Mail;

require_once("conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_wsnGdPKAe4pyTFhCs84qVw");
\Conekta\Conekta::setApiVersion("2.0.0");

class ServiciosController extends Controller
{
    function __construct() {
        $this->app_customer_id = "fd0924a2-30e5-4498-9e0f-76b93a4e6487";
        $this->app_customer_key = "ODAwMjZlM2QtNDNhYy00YTRhLWI1YWUtMGQyOWFkMjcwNDY4";
    }
    /**
     * Muestra los pedidos en curso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $menu = $title = "Mis pedidos activos";
            $pedidos = Servicio::obtener_pedidos(0);

            if ($request->ajax()) {
                return view('pedidos.table', ['pedidos' => $pedidos]);
            }
            return view('pedidos.pedidos', ['pedidos' => $pedidos, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Obtiene la información de un pedido en específico y su número de guía en caso de que tenga uno.
     *
     * @return $pedidos
     */
    public function obtener_pedido_por_id(Request $request)
    {
        $pedido = Servicio::obtener_pedidos($request->status, $request->pedido_id);
        
        return $pedido;
    }

    /**
     * Carga la lista de los repartidores disponibles, en caso de que ya exista un repartidor asignado a un pedido, este será excluido de la lista para ser listado en el select.
     *
     * @return $pedidos
     */
    public function cargar_repartidores_disponibles(Request $request)
    {
        $repartidor_id = $request->repartidor_id ? $request->repartidor_id : false;
        return Repartidor::filtrar_repartidores(1, $repartidor_id);
    }

    /**
     * Asigna un repartidor a un pedido.
     *
     * @return json
     */
    public function asignar_repartidor(Request $request)
    {
        Servicio::where('id', $request->servicio_id)
        ->update(['repartidor_id' => $request->repartidor_id]);

        $pedido = Servicio::where('id', $request->servicio_id)
        ->first();

        $player_id [] = Usuario::obtener_player_id($pedido->usuario_id);
        $mensaje = "Hemos asignado su pedido a uno de nuestros repartidores, en breve se pondrá en camino a tu dirección.";
        $header = "¡Pedido asignado a repartidor!";
        $data = array('msg' => 'repartidor asignado');
        app('App\Http\Controllers\dataAppController')->enviar_notificacion_individual($this->app_customer_id, $header, $mensaje, $data, $player_id, $this->app_customer_key);

        return ['msg' => 'Repartidor asignado correctamente al pedido con el ID '. $request->servicio_id];
    }

    /**
     * Muestra los pedidos finalizados.
     *
     * @return \Illuminate\Http\Response
     */
    public function pedidos_finalizados(Request $request)
    {
        if (auth()->check()) {
            $menu = $title = "Pedidos finalizados";
            $pedidos = Servicio::obtener_pedidos(1);
            $remove_button = true;

            if ($request->ajax()) {
                return view('pedidos.table', ['pedidos' => $pedidos]);
            }
            return view('pedidos.pedidos', ['pedidos' => $pedidos, 'remove_button' => $remove_button, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }
}
