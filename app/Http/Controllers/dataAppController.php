<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faq;
use App\Menu;
use App\Cupon;
use App\Horario;
use App\Pedidos;
use App\Usuario;
use App\Servicio;
use App\Producto;
use App\Categoria;
use App\Repartidor;
use App\Subcategoria;
use App\TipoProducto;
use App\PedidoDetalles;
use App\PedidoFavorito;
use App\FavoritoDetalle;
use App\FotoPlaceholder;
use App\ServicioDetalle;
use App\UsuarioDireccion;
use Session;
use Auth;
use Mail;
use PDO;
use DB;

require_once("conekta-php-master/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_B7qCuzsnSqJNX8kwvgfy1g");
\Conekta\Conekta::setApiVersion("2.0.0");
\Conekta\Conekta::setLocale('es');

class dataAppController extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->actual_datetime = date('Y-m-d H:i:s');
        $this->actual_time = date('H:i:s');
        $this->day_number = date('w');
        $this->app_customer_id = "fd0924a2-30e5-4498-9e0f-76b93a4e6487";
        $this->app_customer_key = "ODAwMjZlM2QtNDNhYy00YTRhLWI1YWUtMGQyOWFkMjcwNDY4";
    }

    /**
     * Crea un nuevo usuario en caso de que el email proporcionado no se haya utilizado antes para un usuario.
     *
     * @param  Request $request
     * @return $usuario_app->id si es correcto el inicio de sesión o 0 si el email proporcionado se encuentra ya registrado.
     */
    public function registro_app(Request $request) 
    {
        if (count(Usuario::buscar_usuario_por_correo($request->correo))) {
            if ($request->red_social) {
                $usuario_app = Usuario::where('correo', $request->correo)
                ->first();
                
                $this->logs($usuario_app->id);

                return $usuario_app;
            }
            return 0;
        } else {
            $usuario_app = new Usuario;

            if (!$request->red_social) {
                $usuario_app->password = md5($request->password);
                $usuario_app->celular = $request->celular;
            } 
            $usuario_app->nombre = $request->nombre;
            $usuario_app->apellido = $request->apellido;
            $usuario_app->correo = $request->correo;
            $request->foto_perfil ? $usuario_app->foto_perfil = $request->foto_perfil : '';
            $usuario_app->red_social = $request->red_social;
            $usuario_app->player_id = $request->player_id;

            $usuario_app->status = 1;
            $usuario_app->tipo = 1;//Significa que el usuario es un cliente
            $usuario_app->created_at = $this->actual_datetime;

            $usuario_app->save();
            
            $this->logs($usuario_app->id);

            return Usuario::where('id', $usuario_app->id)
            ->first();
        }
    }

    /**
     * Valida que los datos de un login sean correctos en la aplicación del cliente y registra un log
     *
     * @param  Request  $request
     * @return $usuario si es correcto el inicio de sesión o 0 si los datos son incorrectos.
     */
    public function login_app_cliente(Request $request) 
    {
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $usuario = Usuario::where('usuario.correo', '=', $request->correo)
        ->where('usuario.password', '=', md5($request->password))
        ->where('usuario.status', '=', 1)
        ->where('usuario.tipo', '=', 1)
        ->first();

        if (count($usuario) > 0) {
            $this->logs($usuario['id']);
            return $usuario;
        } else {
            return 0;
        }
    }

    /**
     * Valida que los datos de un login sean correctos en la aplicación del repartidor y registra un log
     *
     * @param  Request  $request
     * @return $usuario si es correcto el inicio de sesión o 0 si los datos son incorrectos.
     */
    public function login_app_repartidor(Request $request) 
    {
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $usuario = Usuario::where('usuario.correo', '=', $request->correo)
        ->where('usuario.password', '=', md5($request->password))
        ->where('usuario.status', '=', 1)
        ->where('usuario.tipo', '=', 2)
        ->first();

        if (count($usuario) > 0) {
            $this->logs($usuario['id']);
            return $usuario;
        } else {
            return 0;
        }
    }

    /**
     * Actualiza todos los datos de un usuario a excepción de la foto de perfil, contraseña y correo.
     *
     * @param  Request  $request
     * @return $usuario_app
     */
    public function actualizar_datos_usuario(Request $request) 
    {
        $usuario_app = Usuario::find($request->id);

        if (count($usuario_app)) {
            $request->password ? $usuario_app->password = md5($request->password) : '';
            $request->nombre ? $usuario_app->nombre = $request->nombre : '';
            $request->apellido ? $usuario_app->apellido = $request->apellido : '';
            $request->celular ? $usuario_app->celular = $request->celular : '';

            $usuario_app->save();

            return $usuario_app;
        }

        return ['msg'=>'Sin actualizar'];
    }

    /**
     * Actualiza la contraseña de un usuario.
     *
     * @param  Request  $request
     * @return $usuario_app
     */
    public function actualizar_password_usuario(Request $request) 
    {
        $usuario_app = Usuario::find($request->id);

        if (count($usuario_app)) {
            $usuario_app->password = md5($request->password);

            $usuario_app->save();

            return $usuario_app;
        }

        return ['msg'=>'Usuario inválido.'];
    }

    /**
     * Agrega una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function agregar_direccion_usuario_app(Request $request) 
    {
        $direccion = new UsuarioDireccion;

        $direccion->usuario_id = $request->usuario_id;
        $direccion->recibidor = $request->recibidor;
        $direccion->calle = $request->calle;
        $direccion->colonia = $request->colonia;
        $direccion->num_ext = $request->num_ext;
        $direccion->num_int = $request->num_int;
        $direccion->estado =  $request->estado;
        $direccion->ciudad = $request->ciudad;
        $direccion->pais = 'MX';
        $direccion->codigo_postal = $request->codigo_postal;
        $direccion->residencial = $request->residencial;
        $direccion->latitud = $request->latitud;
        $direccion->longitud = $request->longitud;
        $direccion->is_main = 0;

        $direccion->save();

        return $direccion;
    }

    /**
     * Actualizar una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function actualizar_direccion_usuario_app(Request $request) 
    {
        $direccion = UsuarioDireccion::find($request->id);

        if (count($direccion)) {
            $direccion->recibidor = $request->recibidor;
            $direccion->calle = $request->calle;
            $direccion->colonia = $request->colonia;
            $direccion->num_ext = $request->num_ext;
            $direccion->num_int = $request->num_int;
            $direccion->estado =  $request->estado;
            $direccion->ciudad = $request->ciudad;
            $direccion->codigo_postal = $request->codigo_postal;
            $direccion->residencial = $request->residencial;
            $direccion->latitud = $request->latitud;
            $direccion->longitud = $request->longitud;

            $direccion->save();

            return $direccion;
        }

        return ['msg' => 'Error actualizando la dirección']; 
    }

    /**
     * Elimina una dirección de envío para un usuario
     *
     * @param  Request  $request
     * @return $direccion
     */
    public function eliminar_direccion_usuario_app(Request $request) 
    {
        $direccion = UsuarioDireccion::find($request->id);

        if (count($direccion)) {

            $direccion->delete();

            return ['msg' => 'Dirección eliminada correctamente'];
        }

        return ['msg' => 'Error eliminando la dirección'];
    }

    /**
     * Muestra una lista de todas las direcciones del usuario de la aplicación
     *
     * @param  Request  $request
     * @return $direcciones
     */
    public function listar_direcciones(Request $request) 
    {
        $direcciones = UsuarioDireccion::where('usuario_id', $request->usuario_id)
        ->get();

        if (count($direcciones)) {
            return $direcciones;
        }

        return ['msg' => 'El usuario no cuenta con direcciones.'];
    }

    /**
     * Marca un pedido como terminado y pagado a través del código de liberación.
     *
     * @param  Request $request
     * @return json($msg)
     */
    public function liberar_pedido(Request $request) 
    {
        $pedido_id = $request->pedido_id;
        $codigo = strtoupper($request->codigo);

        $pedido = Servicio::where('id', $pedido_id)
        ->where('codigo_liberacion', $codigo)
        ->first();

        if ($pedido) {
            Servicio::where('id', $pedido_id)
            ->where('codigo_liberacion', $codigo)
            ->update(['is_finished' => 1, 'status' => 'paid', 'activo' => 0]);

            $player_id [] = Usuario::obtener_player_id($pedido->usuario_id);
            $mensaje = "Su pedido ha sido entregado exitósamente, gracias por confiar en nosotros.";
            $header = "Pedido finalizado.";
            $data = array('msg' => 'Pedido finalizado');
            //$this->enviar_notificacion_a_todos();
            $this->enviar_notificacion_individual($this->app_customer_id, $header, $mensaje, $data, $player_id, $this->app_customer_key);

            return ['msg' => 'Pedido liberado'];
        }
        return 0;
    }

    /**
     * Califica un servicio y valida si la calificación corresponde a un usuario o estilista (En caso de ser estilista, se va a marcar el servicio como finalizado.
     *
     * @return $cupones
     */
    public function calificar_servicio(Request $request)
    {
        $servicio = Servicio::find($request->pedido_id);

        if ($servicio) {
            $servicio->puntuacion = $request->puntuacion;

            $servicio->save();
            return ['msg' => 'Calificado'];
        }
        return 0;
        //return ['msg' => 'El servicio que trató de calificar no existe o no es válido'];
    }

    /**
     * Regresa todos los productos enlistados por categoría.
     *
     * @return $productos
     */
    public function productos_categoria()
    {
        $categorias = Categoria::select(DB::raw('id, categoria'))->get();
        foreach ($categorias as $categoria) {
            $categoria->productos = Producto::select(DB::raw('id, nombre, precio, descripcion, gramos_base, precio_porcion, cantidad_porcion, foto_producto, precio_chico, precio_grande, status'))
            ->where('categoria_id', $categoria->id)
            ->get();
        }
        return $categorias;
    }

    /**
     * Envía un correo con una nueva contraseña generada por el sistema al email proporcionado,
     * siempre y cuando este exista en la tabla de usuario.
     *
     * @param  string  $email
     * @return ['success'=>true] si el correo fue enviado exitosamente, ['success'=>false] si no se envió.
     */
    public function recuperar_contra(Request $request)
    {
        if (count(Usuario::buscar_usuario_por_correo($request->correo))) {
            $new_pass = str_random(7);
            Usuario::where('correo', $request->correo)
            ->update(['password' => md5($new_pass)]);

            $msg = "Se ha cambiado la contraseña para el acceso a la aplicación cocoinbox.".
            "\nSu nueva contraseña es: ".$new_pass.
            "\nNo brinde a ninguna persona información confidencial sobre sus contraseñas o tarjetas.";
            $subject = "Restablecimiento de contraseña";
            $to = $request->correo;

            $enviado = Mail::raw($msg, function($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            });

            if ($enviado) {
                return ['msg' => 'Enviado', 'contraseña' => $new_pass];
            } else {
                return ['msg' => 'Contraseña actualizada, pero el correo falló al enviarse'];
            }
        }

        return ['msg' => 'Error al enviar correo'];
    }

    /**
     * Actualiza una foto de perfil de un usuario.
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function actualizar_foto(Request $request)
    {
        $target_path = public_path()."/img/usuario_app/";
        $extension = explode('.', basename( $_FILES['file']['name']));
        $nombre_foto = time().'.'.$extension[1];
        $target_path = $target_path . $nombre_foto;
        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            $usuario_app = Usuario::find($request->id);
            //$usuario->foto_perfil = url().'/'.$name;
            $usuario_app->foto_perfil = url()."/"."img/usuario_app/".$nombre_foto;
            $usuario_app->save();
            return $usuario_app->foto_perfil;
        } else {
            echo $target_path;
            echo "There was an error uploading the file, please try again!";
            return 0;
        }
    }

    /**
     * Registra un nuevo inicio de sesión de la aplicación.
     *
     * @param  $id_usuario
     */
    public function logs($id_usuario) {
        DB::table('registro_logs')->insert([
            'user_id' => $id_usuario,
            'fechaLogin' => DB::raw('CURDATE()'),
            'realTime' => DB::raw('NOW()')
        ]);
    }

    /**
     *===================================================================================================================================
     *=                                     Empiezan las funciones relacionadas a la api de conekta                                     =
     *===================================================================================================================================
     */
    
    /**
     * Genera un token
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function generar_token(Request $request)
    {
        return $request->conektaTokenId;
    }

    /**
     * Carga el formulario de prueba para conekta.
     *
     * @param  Request $request
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */
    public function cargar_form_conekta()
    {
        $title = $menu = 'Pedidos';
        return view('pruebas_conekta.form_prueba', ['menu' => $menu, 'title' => $title]);
    }    

    /**
     * Busca si existe un usuario con un customer_id_conekta en la base de datos, si lo encuentra actualiza su método de pago
     * Caso contrario, se crea un cliente con la información del request.
     * Después, se crea la orden con los datos del request llamando la función procesar_orden()
     *
     * @param  Request $request
     * @return Retorna ['msg' => 'Cargo realizado'] en caso de que se haya aprobado el cargo
     *         Caso contrario, regresará errores de conekta
     */
    public function crear_cliente(Request $request)
    {
        if(!$this->validar_horario()) {
            return ['msg' => 'Timeout'];
        }

        $direccion = Usuario::direccion_usuario($request->direccion_id);
        if(!$direccion) {//Si no hay una dirección de envío no se procesa el pago
            return ['msg' => 'No se agregó ninguna dirección de envío.'];
        }
        $direccion_num = $direccion['calle']. " No. Ext: ". $direccion['num_ext'];
        $direccion_num = $direccion['num_int'] ? $direccion_num. " No. Int: ". $direccion['num_int'] : $direccion_num;

        $customer_id_conekta = Usuario::buscar_id_conekta_usuario_app($request->correo);
        if ($customer_id_conekta) {//Se registrará una tarjeta nuevamente para el usuario
            $customer = \Conekta\Customer::find($customer_id_conekta);

            if (count($customer['payment_sources'])) {//Si tiene algún método de pago extra, entonces que se elimine y se crea uno nuevo
                $customer->payment_sources[0]->delete();
            }
            $customer = \Conekta\Customer::find($customer_id_conekta);//Se tiene que volver a buscar
            $source = $customer->createPaymentSource(array(
                'token_id' => $request->conektaTokenId,
                'type'     => 'card'
            ));
            
            $customer = \Conekta\Customer::find($customer_id_conekta);
            $response = $this->procesar_orden($request, $customer_id_conekta, $direccion);
            return $response;

        } else {
            try {
                $cliente = \Conekta\Customer::create(
                    array(
                        "name" => $request->nombre,
                        "email" => $request->correo,
                        "phone" => $request->telefono,
                        "payment_sources" => array(
                            array(
                                "type" => "card",
                                "token_id" => $request->conektaTokenId
                            )
                        ),//payment_sources
                        'shipping_contacts' => array(array(
                            'phone' => $request->telefono,
                            'receiver' => $direccion['recibidor'],  
                            'address' => array(
                                'street1' => $direccion_num,
                                'city' => $direccion['ciudad'],
                                'state' => $direccion['estado'],
                                'country' => $direccion['pais'],
                                'postal_code' => $direccion['codigo_postal'],
                                'residential' => $direccion['residencial']
                            )
                        ))
                    )//customer
                );

                Usuario::actualizar_id_conekta_usuario_app($request->correo, $cliente['id']);
                $customer = \Conekta\Customer::find($cliente->id);
                $response = $this->procesar_orden($request, $cliente->id, $direccion);

                return $response;
                
            } catch (\Conekta\ErrorList $errorList) {
                $msg_errors = '';
                foreach ($errorList->details as &$errorDetail) {
                    $msg_errors .= $errorDetail->getMessage();
                }
                return ['msg' => 'Datos del cliente incorrectos: '.$msg_errors];
            }
        }
    }

    /**
     * Procesa una orden, además de aplicar un porcentaje de descuento en caso de contar con un cupón válido.
     *
     * @param  Request $request
     * @return Retorna ['msg' => 'Cargo realizado'] en caso de que se haya aprobado el cargo
     *         Caso contrario, regresará errores de conekta
     */
    public function procesar_orden($request, $customer_id_conekta, $direccion)
    {
        $charge_ar = array();
        $charge_ar["type"] = "default";

        $direccion_num = $direccion['calle']. " No. Ext: ". $direccion['num_ext'];
        $direccion_num = $direccion['num_int'] ? $direccion_num. " No. Int: ". $direccion['num_int'] : $direccion_num;

        try {
            $order_args = array(
                "line_items" => $request->productos,
                "shipping_lines" => array(
                    array(
                        "amount" => 0,
                        "carrier" => "COCO INBOX"
                    )
                ), //shipping_lines
                "currency" => "MXN",
                "customer_info" => array(
                    "customer_id" => $customer_id_conekta
                ), //customer_info
                "shipping_contact" => array(
                    "phone" => $request->telefono,
                    "receiver" => $direccion['recibidor'],
                    "address" => array(
                        'street1' => $direccion_num,
                        'city' => $direccion['ciudad'],
                        'state' => $direccion['estado'],
                        'country' => $direccion['pais'],
                        'postal_code' => $direccion['codigo_postal'],
                        'residential' => $direccion['residencial']
                    )//address
                ), //shipping_contact
                "charges" => array(
                    array(
                        "payment_method" => $charge_ar
                    ) //first charge
                ) //charges
            );//order

            $costo_adicional = $this->calcular_costo_extra($request->productos);

            if ($costo_adicional) {
                $order_args['tax_lines'] = array(
                    array(
                        'description' => 'IVA',
                        'amount' => $costo_adicional
                    )
                );
            }

            $order = \Conekta\Order::create(
                $order_args
            );

            /*Se inserta un nuevo pedido en la base de datos*/
            $servicio = new Servicio;

            $servicio->conekta_order_id = $order->id;
            $servicio->usuario_id = $request->usuario_id;
            $servicio->nombre_cliente = $request->nombre;
            $servicio->correo_cliente = $request->correo;
            $servicio->customer_id_conekta = $customer_id_conekta;
            $servicio->costo_total = $order->amount;
            $servicio->telefono = $request->telefono;
            $servicio->tipo_pago = 'tarjeta';
            $servicio->status = 'paid';
            $servicio->recibidor = $direccion['recibidor'];
            $servicio->calle = $direccion['calle'];
            $servicio->entre = $direccion['entre'];
            $servicio->num_ext = $direccion['num_ext'];
            $servicio->num_int = $direccion['num_int'];
            $servicio->ciudad = $direccion['ciudad'];
            $servicio->estado = "Jalisco";
            $servicio->pais = $direccion['pais'];
            $servicio->codigo_postal = $direccion['codigo_postal'];
            $servicio->latitud = $direccion['latitud'];
            $servicio->longitud = $direccion['longitud'];
            $servicio->codigo_liberacion = $this->generar_codigo_liberacion();
            $servicio->comentarios = $request->comentarios;
            $servicio->last_digits = $request->last_digits;
            $servicio->datetime_formated = $request->datetime_formated;
            $servicio->created_at = $this->actual_datetime;

            $servicio->save();

            $this->guardar_detalles_servicio($servicio->id, $request->productos);

            return ['msg' => 'Cargo realizado'];
            
        } catch (\Conekta\ErrorList $errorList) {
            $msg_errors = '';
            
            foreach($errorList->details as &$errorDetail) {
                $msg_errors .= $errorDetail->getMessage();
            }
            return ['msg' => 'Cargo no realizado: '.$msg_errors];
        }
    }//End function

    /**
     * Guarda los detalles de una orden.
     * 
     */
    public function guardar_detalles_servicio($servicio_id, $productos)
    {
        foreach ($productos as $producto) {
            $producto_detalle = Producto::where('id', $producto['producto_id'])->first();

            $item = New ServicioDetalle;

            $item->servicio_id = $servicio_id;
            $item->producto_id = $producto['producto_id'];//Guardamos el id del producto
            $item->categoria_id = $producto_detalle['categoria_id'];//Guardamos el id de la categoría del producto
            $item->nombre_producto = $producto['name'];
            $item->foto_producto = $producto_detalle['foto_producto'];
            $item->precio = $producto['unit_price'];
            $item->cantidad = $producto['quantity'];
            $item->gramos_base = $producto_detalle['gramos_base'];
            $item->porciones_adicionales = $producto['aditional_portion'] ? $producto['aditional_portion'] : '';
            $item->precio_porcion = $producto_detalle['precio_porcion'];
            $item->peso_porcion = $producto_detalle['cantidad_porcion'];
            $item->drink = $producto['drink'];
            $item->created_at = date('Y-m-d H:i:s');

            $item->save();
        }
    }

    /**
     * Obtiene todas las preguntas frecuentes de la aplicación.
     * 
     */
    public function obtener_preguntas_frecuentes()
    {
        return Faq::faqs_detalles();
    }

    /**
     * Regresa todos los pedidos asignados a un repartidor.
     *
     * @return $pedidos
     */
    public function obtener_pedidos_repartidor(Request $request)
    {
        if ($request->finalizado) {
            $pedidos = Servicio::obtener_pedidos_finalizados_repartidor($request->repartidor_id);
        } else {
            $pedidos = Servicio::obtener_pedidos_activos_repartidor($request->repartidor_id);
        }

        foreach ($pedidos as $pedido) {
            $pedido->detalles = Servicio::detalle_pedido($pedido->id);
        }
        return $pedidos;
    }

    /**
     * Regresa todos los pedidos realizados por un cliente.
     *
     * @return $pedidos
     */
    public function obtener_pedidos_usuario(Request $request)
    {
        if ($request->finalizado) {
            $pedidos = Servicio::obtener_pedidos_finalizados_usuario($request->usuario_id);
        } else {
            $pedidos = Servicio::obtener_pedidos_activos_usuario($request->usuario_id);
        }

        foreach ($pedidos as $pedido) {
            $pedido->detalles = Servicio::detalle_pedido($pedido->id);
            
            /*Querys para traer los detalles del pedido en caso de que esté marcado como favorito*/
            $favorito = PedidoFavorito::where('servicio_id', $pedido->id)->first();
            $favorito['detalles_favoritos'] = FavoritoDetalle::select(DB::raw('cantidad, porciones_adicionales, medida_bebida, productos.*, categorias.categoria'))
            ->leftJoin('productos', 'favoritos_detalles.producto_id', '=', 'productos.id')
            ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->where('pedido_favorito_id', $favorito['id'])
            ->where('productos.status', 1)
            ->get();
            
            $pedido->favorito = $favorito;
        }
        return $pedidos;
    }

    /**
     * Guarda un pedido como favorito y guarda sus detalles.
     *
     * @return $favorito
     */
    public function guardar_pedido_favoritos(Request $request)
    {
        $favorito = New PedidoFavorito;
        $favorito->servicio_id = $request->servicio_id;
        $favorito->usuario_id = $request->usuario_id;
        $favorito->save();

        $detalles = ServicioDetalle::where('servicio_id', $request->servicio_id)->get();
        foreach ($detalles as $detalle) {
            $favorito_detalle = New FavoritoDetalle;
            $favorito_detalle->pedido_favorito_id = $favorito->id;
            $favorito_detalle->producto_id = $detalle->producto_id;
            $favorito_detalle->cantidad = $detalle->cantidad;
            $favorito_detalle->porciones_adicionales = $detalle->porciones_adicionales;

            if (strpos($detalles, 'chico') > -1) {
                $favorito_detalle->medida_bebida = 'chico';
            } else if (strpos($detalles, 'grande') > -1) {
                $favorito_detalle->medida_bebida = 'grande';
            } else {
                $favorito_detalle->medida_bebida = 'chico';//Se tomará por defecto que el usuario pidió una bebida chica, aunque nunca debería pasar por este else.
            }
            $favorito_detalle->save();
        }

        return ['msg' => 'Pedido guardado como favorito'];
    }

    /**
     * Remueve un pedido como favorito y elimina también sus detalles.
     *
     * @return $favorito
     */
    public function remover_pedido_favoritos(Request $request)
    {
        $favorito = PedidoFavorito::where('servicio_id', $request->servicio_id);
        $favorito_id = $favorito->first()->id;
        $favorito = $favorito->delete();
        $detalles = FavoritoDetalle::where('pedido_favorito_id', $favorito_id)->delete();

        if ($favorito && $detalles) {
            return ['msg' => 'Pedido eliminado de favoritos'];
        } else {
            return ['msg' => 'Hubo un error al eliminar los registros, trate nuevamente'];
        }
    }

    /**
     *Retorna el porcentaje de descuento de la orden en caso de que exista un cupón de descuento
     * 
     * @param  decimal $porcentaje
     */
    public function crear_pedido_efectivo(Request $request)
    {
        if(!$this->validar_horario()) {
            return ['msg' => 'Timeout'];
        }

        $direccion = Usuario::direccion_usuario($request->direccion_id);

        /*Se inserta un nuevo pedido en la base de datos*/
        $servicio = new Servicio;

        $servicio->usuario_id = $request->usuario_id;
        $servicio->nombre_cliente = $request->nombre;
        $servicio->correo_cliente = $request->correo;
        $servicio->telefono = $request->telefono;
        $servicio->tipo_pago = 'efectivo';
        $servicio->status = 'pending_payment';
        $servicio->recibidor = $direccion['recibidor'];
        $servicio->calle = $direccion['calle'];
        $servicio->entre = $direccion['entre'];
        $servicio->num_ext = $direccion['num_ext'];
        $servicio->num_int = $direccion['num_int'];
        $servicio->ciudad = $direccion['ciudad'];
        $servicio->estado = $direccion['estado'];
        $servicio->pais = $direccion['pais'];
        $servicio->codigo_postal = $direccion['codigo_postal'];
        $servicio->latitud = $direccion['latitud'];
        $servicio->longitud = $direccion['longitud'];
        $servicio->codigo_liberacion = $this->generar_codigo_liberacion();
        $servicio->comentarios = $request->comentarios;
        $servicio->datetime_formated = $request->datetime_formated;
        $servicio->created_at = $this->actual_datetime;

        $servicio->save();

        $total = $this->guardar_detalles_servicio_efectivo($servicio->id, $request->productos);

        Servicio::where('id', $servicio->id)->update(['costo_total' => $total]);

        return ['msg' => 'Orden registrada correctamente.'];
    }

    /**
     * Guarda los detalles de una orden.
     * @return int $total
     */
    public function guardar_detalles_servicio_efectivo($servicio_id, $productos)
    {
        $total = 0;
        foreach ($productos as $producto) {
            $producto_detalle = Producto::where('id', $producto['producto_id'])->first();

            $item = New ServicioDetalle;

            $item->servicio_id = $servicio_id;
            $item->producto_id = $producto['producto_id'];//Guardamos el id del producto
            $item->categoria_id = $producto_detalle['categoria_id'];//Guardamos el id de la categoría del producto
            $item->nombre_producto = $producto['name'];
            $item->foto_producto = $producto_detalle['foto_producto'];
            $item->precio = $producto['unit_price'];
            $item->cantidad = $producto['quantity'];
            $item->porciones_adicionales = $producto['aditional_portion'] ? $producto['aditional_portion'] : '';
            $item->precio_porcion = $producto_detalle['precio_porcion'];
            $item->peso_porcion = $producto_detalle['cantidad_porcion'];
            $item->drink = $producto['drink'];
            $item->created_at = date('Y-m-d H:i:s');

            $item->save();

            if ($producto['drink'] == 1) {//Se trata de una bebida
                $total += ($producto['unit_price'] * $producto['quantity']);
            } else {//Se trata de un platillo
                if ($producto['aditional_portion']) {//Suma del plato más su porción
                    $total += (($producto['aditional_portion'] * ($producto_detalle['precio_porcion'] * 100) * $producto['quantity']) + ($producto['quantity'] * $producto['unit_price']));
                } else {//Costo del plato
                    $total += ($producto['quantity'] * $producto['unit_price']);
                }
            }
        }
        return $total;
    }

    /**
     * Valida si es un horario válido para realizar pedidos.
     *
     * @return boolean
     */
    public function validar_horario()
    {
        $dia = $this->day_number;
        $hora = $this->actual_time;
        $horario = Horario::whereRaw("(? BETWEEN hora_inicio AND hora_fin) AND dia = ? AND status = 1")
        ->setBindings([$hora, $dia])
        ->first();

        return $horario ? true : false;
    }

    /**
     * Calcula el extra de las porciones adicionales del servicio.
     * 
     * @return Int $extra 
     */
    public function calcular_costo_extra($productos)
    {
        $extra = 0;

        foreach ($productos as $producto) {
            $producto_detalle = Producto::where('id', $producto['producto_id'])->first();

            if ($producto['drink'] != 1) {//Se trata de un platillo
                if ($producto['aditional_portion']) {//Verifica que haya porciones adicionales
                    $extra += (($producto['aditional_portion'] * ($producto_detalle['precio_porcion'] * 100) * $producto['quantity']));
                }
            }
        }

        return $extra;
    }

    /**
     * Genera un código de liberación.
     * 
     * @return String $codigo 
     */
    public function generar_codigo_liberacion()
    {
        $codigo = strtoupper(str_random(8));
        $existe_codigo = Servicio::where('codigo_liberacion', $codigo)->get();
        while (count($existe_codigo)) {
            $codigo = strtoupper(str_random(8));
            $existe_codigo = Servicio::where('codigo_liberacion', $codigo)->get();
        }

        return $codigo;
    }
    
    /**
     *========================================================================================================================================================================
     *=                                                       Empiezan los métodos para las coordenadas de los pedidos                                                       =
     *========================================================================================================================================================================
     */

    /**
     * Marca un pedido como en camino a ser entregado, recibiendo las coordenadas actuales del repartidor.
     * 
     * @return json $msg
     */
    public function encaminar_pedido(Request $request)
    {
        $servicio = Servicio::where('id', $request->pedido_id)->update(['activo' => 1]);
        $repartidor = $this->actualizar_coordenadas($request->repartidor_id, $request->latitud, $request->longitud);

        if ($servicio && $repartidor) {
            return ['msg' => 'Las coordenadas han sido actualizadas y el pedido marcado como activo.'];
        }
        return 0;
        //return ['msg' => 'Hubo un error actualizando las coordenadas o marcando el pedido como activo, por favor, trate nuevamente'];
    }

    /**
     * Actualiza las coordenadas de un repartidor con un pedido activo.
     * 
     * @return boolean
     */
    public function actualizar_coordenadas_repartidor(Request $request)
    {
        $repartidor = $this->actualizar_coordenadas($request->repartidor_id, $request->latitud, $request->longitud);

        if ($repartidor) {
            return ['msg' => 'Coordenadas actualizadas'];
        }
        return 0;
        //return ['msg' => 'Error al actualizar'];
    }

    /**
     * Actualiza las coordenadas de un repartidor con un pedido activo.
     * 
     * @return boolean
     */
    public function actualizar_coordenadas($repartidor_id, $latitud, $longitud)
    {
        $usuario = Usuario::where('id', $repartidor_id)->where('tipo', 2)->first();
        
        if ($usuario) {
            $repartidor = Repartidor::where('usuario_id', $usuario->id)->update(['latitud' => $latitud, 'longitud' => $longitud]);
            if ($repartidor) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Obtiene las coordenadas del repartidor que lleva un pedido activo.
     * 
     * @return json $coordenadas
     */
    public function obtener_coordenadas_pedido(Request $request)
    {
        $repartidor = Usuario::leftJoin('repartidores', 'repartidores.usuario_id', '=', 'usuario.id')
        ->where('usuario.id', $request->repartidor_id)->first();

        if ($repartidor) {
            return ['latitud' => $repartidor->latitud, 'longitud' => $repartidor->longitud];
        }
        return ['msg' => 'Id de repartidor inválido'];
    }

    /**
     *========================================================================================================================================================================
     *=                                                      Empiezan los métodos para las notificaciones con onesignal                                                      =
     *========================================================================================================================================================================
     */

    /**
     * Actualiza el player_id de un usuario
     * 
     * @return json
     */
    public function actualizar_player_id(Request $req)
    {
        $user = Usuario::find($req->usuario_id);
        $user->player_id = $req->player_id;
        $user->save();

        return response(['msg' => 'Player ID modificado con éxito'], 200);
    }

    /**
    * Envía una notificación a todos los usuarios de la aplicación
    * @return $response
    */
    public function enviar_notificacion_a_todos() 
    {
        $content = array(
            "en" => 'English Message'
        );
        
        $fields = array(
            'app_id' => $this->app_customer_id,//"15c4f224-e280-436d-9bb8-481c11fb4c3c",
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        /*print("\nJSON sent:\n");
        print($fields);*/
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic ODAwMjZlM2QtNDNhYy00YTRhLWI1YWUtMGQyOWFkMjcwNDY4'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        //return $response;
    }

    /**
    * Envía una notificación individual a un usuario que puede ser repartidor o cliente
    * @return $response
    */
    public function enviar_notificacion_individual($app_id, $header, $mensaje, $data, $player_ids, $app_customer_key)
    {
        $content = array(
            "en" => $mensaje
        );
        
        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => $player_ids,
            'data' => $data,
            'header' => $header,
            'contents' => $content,
            'small_icon' => 'http://cocoinbox.bsmx.tech/public/img/icon.png',
            'large_icon' => 'http://cocoinbox.bsmx.tech/public/img/icon.png'
        );
        
        
        $fields = json_encode($fields);
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_customer_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    /**
    * Envía una notificación individual a un usuario cliente que le indica que su pedido está a aproximadamente 100 metros de llegar.
    * @return $response
    */
    public function enviar_notificacion_pedido_cercano(Request $request)
    {
        $player_ids [] = Usuario::obtener_player_id($request->usuario_id);

        $app_id = $this->app_customer_id;
        $app_customer_key = $this->app_customer_key;
        $header = $request->header;
        $mensaje = $request->mensaje;
        $data = $request->data;

        $content = array(
            "en" => $mensaje
        );
        
        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => $player_ids,
            'data' => $data,
            'header' => $header,
            'contents' => $content,
            'small_icon' => 'http://cocoinbox.bsmx.tech/public/img/icon.png',
            'large_icon' => 'http://cocoinbox.bsmx.tech/public/img/icon.png'
        );

        $fields = json_encode($fields);
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_customer_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
