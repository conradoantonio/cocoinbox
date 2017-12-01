<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repartidor;
use App\Usuario;

class RepartidoresController extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->actual_datetime = date('Y-m-d H:i:s');
    }
    /**
     * Carga la tabla de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Repartidores";
        $menu = "Repartidores";
        $repartidores = Repartidor::repartidor_detalles();
        if ($request->ajax()) {
            return view('repartidores.table', ['repartidores' => $repartidores]);
        }
        return view('repartidores.repartidores', ['repartidores' => $repartidores, 'menu' => $menu, 'title' => $title]);
    }

	/**
     * Guarda un repartidor y crea su usuario.
     *
     * @return json($msg)
     */
    public function guardar(Request $request)
    {    
    	$validado = Usuario::buscar_usuario_por_correo($request->correo);

        if (count($validado)) {
            return response(['msg' => 'Correo no disponible', 'status' => 'bad request'], 200);
        } else {
        	/*Creación del usuario del repartidor*/
            $usuario = new Usuario;
            $usuario->password = md5($request->password);
            $usuario->nombre = $request->nombre;
            $usuario->apellido = $request->apellido;
            $usuario->correo = $request->correo;
            $usuario->celular = $request->celular;
            $usuario->tipo = 2;
            $usuario->created_at = $this->actual_datetime;
       
            $usuario->save();
            $id = $usuario->id;

            /*Creación de los detalles del repartidor*/
            $repartidor = new Repartidor;

            $repartidor->usuario_id = $id;

            $repartidor->comprobante_domicilio = $this->validar_archivo($request->file('comprobante_domicilio'), 'comprobante_domicilio', $id);
            $repartidor->licencia = $this->validar_archivo($request->file('licencia'), 'licencia', $id);
            $repartidor->solicitud_trabajo = $this->validar_archivo($request->file('solicitud_trabajo'), 'solicitud_trabajo', $id);
            $repartidor->credencial_elector = $this->validar_archivo($request->file('credencial_elector'), 'credencial_elector', $id);

	        $repartidor->save();
            return response(['msg' => 'Saved!', 'status' => 'ok'], 200);
        }
    }

    /**
     * Edita un repartidor y su usuario.
     *
     * @return json($msg)
     */
    public function editar(Request $request)
    {
        $validado = Usuario::buscar_usuario_por_correo($request->correo, $request->correo_viejo);
        $user_id = $request->user_id;
        $repartidor_id = $request->repartidor_id;

        if (count($validado)) {
            return response(['msg' => 'Correo no disponible', 'status' => 'bad request'], 200);
        } else {
            /*Se editan los datos del usuario del repartidor*/
            $usuario = Usuario::find($user_id);
            if ($usuario) {

                $request->password ? $usuario->password = md5($request->password) : '';
                $usuario->nombre = $request->nombre;
                $usuario->apellido = $request->apellido;
                $usuario->correo = $request->correo;
                $usuario->celular = $request->celular;
           
                $usuario->save();
            }

            /*Se editan los detalles del repartidor*/
            $repartidor = Repartidor::find($repartidor_id);
            if ($repartidor) {

                $request->file('comprobante_domicilio') ? $repartidor->comprobante_domicilio = $this->validar_archivo($request->file('comprobante_domicilio'), 'comprobante_domicilio', $user_id) : '';
                $request->file('licencia') ? $repartidor->licencia = $this->validar_archivo($request->file('licencia'), 'licencia', $user_id) : '';
                $request->file('solicitud_trabajo') ? $repartidor->solicitud_trabajo = $this->validar_archivo($request->file('solicitud_trabajo'), 'solicitud_trabajo', $user_id) : '';
                $request->file('credencial_elector') ? $repartidor->credencial_elector = $this->validar_archivo($request->file('credencial_elector'), 'credencial_elector', $user_id) : '';

                $repartidor->save();
            }

            if ($usuario && $repartidor) {
                return response(['msg' => 'Saved!', 'status' => 'ok'], 200);
            } else {
                return response(['msg' => 'Repartidor inválido o no encontrado', 'status' => 'not found'], 200);
            }
        }
    }

    /**
     * Valida los archivos del repartidor.
     *
     * @return json($msg)
     */
    public function validar_archivo($file, $folder, $id)
    {
        $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif", "5"=>"pdf");

        if ($file) {
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $file_name = time().'.'.$extension_archivo;
                $file_path = 'img/repartidores/'.$folder.'/'.$id;
                $file->move($file_path, $file_name);
                return $file_path.'/'.$file_name;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

        
    /**
     * Dibuja un mapa con la ubicación actual de los repartidores.
     *
     * @return view(mapa)
     */
    public function cargar_mapa(Request $request) 
    {
        $title = $menu = "Geolocalización";

        $repartidores = Usuario::leftJoin('repartidores', 'repartidores.usuario_id', '=', 'usuario.id')
        ->where('tipo', 2)
        ->where('status', 1)
        ->get();

        foreach ($repartidores as $row) {
            $coordenadas[] = [$row->nombre.' '.$row->apellido, $row->latitud, $row->longitud, $row->foto_perfil];
        }

        if ($request->ajax()) {
            return $coordenadas;
        }
        
        return view('mapa.mapa', ['coordenadas' => json_encode($coordenadas), 'menu' => $menu, 'title' => $title]);
    }
}
