<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if (Auth::check()) {
		return redirect()->action('LogController@index');
	} else {
    	return view('welcome');//login
    }
});

/*-- Rutas para el login --*/
Route::resource('log', 'LogController');
Route::post('login', 'LogController@store');
Route::get('logout', 'LogController@logout');

/*-- Rutas para el dashboard --*/
Route::get('/dashboard','LogController@index');//Carga solo el panel administrativo
Route::post('/grafica', 'LogController@get_userSesions');//Carga los datos de la gráfica

/*-- Rutas para la pestaña de usuariosSistema --*/
Route::get('/usuarios/sistema','UsersController@index');//Carga la tabla de usuarios del sistema
Route::post('/usuarios/sistema/validar_usuario', 'UsersController@validar_usuario');//Checa si un usuario del sistema existe
Route::post('/usuarios/sistema/guardar_usuario', 'UsersController@guardar_usuario');//Guarda un usuario del sistema
Route::post('/usuarios/sistema/guardar_foto_usuario_sistema', 'UsersController@guardar_foto_usuario_sistema');//Guarda la foto de perfil de un usuario del sistema
Route::post('/usuarios/sistema/eliminar_usuario', 'UsersController@eliminar_usuario');//Elimina un usuario del sistema
Route::post('/usuarios/sistema/change_password', 'UsersController@change_password');//Elimina un usuario del sistema

/*-- Rutas para la pestaña usuariosApp--*/
Route::get('/usuarios/app','UsersController@usuariosApp');//Carga la tabla de usuarios de la aplicación
Route::get('/usuarios/app/exportar_usuarios_app','ExcelController@exportar_usuarios_app');//Exporta todos los usuarios de la aplicación a excel
Route::post('/usuarios/app/guardar_usuario_app', 'UsersController@guardar_usuario_app');//Guarda un nuevo usuario de la aplicación
Route::post('/usuarios/app/editar_usuario_app', 'UsersController@editar_usuario_app');//Edita un usuario de la aplicación
Route::post('/usuario/cambiarStatus', 'UsersController@destroy');//Da de baja un usuario

/*-- Rutas para la pestaña de repartidores--*/
Route::group(['prefix' => 'repartidores'], function () {
	Route::get('/','RepartidoresController@index');//Carga la tabla de repartidores
	Route::post('guardar','RepartidoresController@guardar');//Guarda los datos de un repartidor
	Route::post('editar','RepartidoresController@editar');//Edita los datos de un repartidor
	Route::post('cambiar/status','RepartidoresController@cambiar_status');//Cambia el status de un repartidor
});

/*-- Rutas para la geolocalización --*/
Route::group(['prefix' => 'geolocalizacion', 'middleware' => 'auth'], function () {
	Route::get('/','RepartidoresController@cargar_mapa');//Carga el mapa con la ubicación actual de los repartidores.
	Route::post('/cargar_coordenadas','RepartidoresController@cargar_mapa');//Carga las coordenadas de los repartidores.
});

/*-- Rutas para la pestaña de horarios--*/
Route::group(['prefix' => 'horarios', 'middleware' => 'auth'], function () {
	Route::get('/','HorariosController@index');//Carga la tabla de horarios
	//Route::post('guardar','HorariosController@guardar');//Guarda los datos de un repartidor
	Route::post('editar','HorariosController@editar');//Edita los datos de un repartidor
	Route::post('cambiar/status','HorariosController@cambiar_status');//Cambia el status de un repartidor
});

/*-- Rutas para las notificaciones --*/
Route::group(['prefix' => 'notificaciones_app', 'middleware' => 'auth'], function () {
	Route::get('/','NotificacionesController@index');//Carga el panel para mandar notificaciones a la aplicación.
	Route::post('/enviar/general','NotificacionesController@enviar_notificacion_general');//Manda una notificación a todos los usuarios suscritos de la aplicación.
	Route::post('/enviar/individual','NotificacionesController@enviar_notificacion_individual');//Manda una notificación a los usuarios seleccionados de la áplicación.
});

/*-- Ruta para la pestaña de productos --*/
Route::get('/productos','ProductosController@index');//Carga la tabla de productos del sistema
Route::post('/productos/guardar', 'ProductosController@guardar_producto');//Guarda un producto
Route::post('/productos/editar', 'ProductosController@editar_producto');//Edita un producto
Route::post('/productos/eliminar', 'ProductosController@eliminar_producto');//Elimina un producto
Route::post('/productos/eliminar_multiples', 'ProductosController@eliminar_multiples_productos');//Elimina varios productos
Route::post('/productos/importar_productos', ['as' => '/productos/importar_productos', 'uses' => 'ExcelController@importar_productos']);//Carga los productos a excel
Route::get('/productos/exportar_productos/{fecha_inicio}/{fecha_fin}', 'ExcelController@exportar_productos');//Exporta ciertos productos a excel
Route::post('/productos/cargar_subcategorias', 'ProductosController@cargar_subcategorias');//Carga las subcategorías de una categoría.

/*-- Ruta para los tipos de productos dentro de la pestaña de productos*/
Route::post('/tipo_producto/guardar_tipo_producto', 'ProductosController@guardar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/editar_tipo_producto', 'ProductosController@editar_tipo_producto');//Guarda un tipo de producto.
Route::post('/tipo_producto/eliminar_tipo_producto', 'ProductosController@eliminar_tipo_producto');//Guarda un tipo de producto.

/*-- Rutas para la pestaña de configuración --*/
Route::get('/configuracion/preguntas_frecuentes','ConfiguracionController@preguntas_frecuentes');//Carga la tabla de preguntas frecuentes.
Route::post('/preguntas_frecuentes/guardar_pregunta', 'ConfiguracionController@guardar_pregunta');//Guarda una pregunta
Route::post('/preguntas_frecuentes/editar_pregunta', 'ConfiguracionController@editar_pregunta');//Edita una pregunta
Route::post('/preguntas_frecuentes/eliminar_pregunta', 'ConfiguracionController@eliminar_pregunta');//Elimina una pregunta

/*-- Rutas para la pestaña de subcategorías --*/
Route::get('/subcategorias_app','MenuController@subcategorias');//Muestra las subcategorías de la aplicación.
Route::post('/subcategorias_app/guardar','MenuController@subcategorias_guardar');//Guarda una subcategoría.
Route::post('/subcategorias_app/editar','MenuController@subcategorias_editar');//Edita una subcategoría.
Route::post('/subcategorias_app/eliminar','MenuController@subcategorias_eliminar');//Elimina una subcategoría.
Route::post('/subcategorias_app/eliminar_multiples','MenuController@subcategorias_eliminar_multiples');//Elimina varias subcategorías.

/*-- Rutas para la pestaña de pedidos y pedidos finalizados --*/
Route::get('/pedidos','ServiciosController@index');//Carga la vista para los pedidos realizados del panel
Route::get('/pedidos_finalizados','ServiciosController@pedidos_finalizados');//Carga la vista para los pedidos finalizados.
Route::post('/pedidos/agregar_num_seguimiento','ServiciosController@agregar_num_seguimiento');//Agrega un número de seguimiento a un pedido
Route::post('/pedidos/obtener_info_pedido','ServiciosController@obtener_pedido_por_id');//Obtiene la información de un pedido por su id.
Route::post('/pedidos/cargar_repartidores_disponibles','ServiciosController@cargar_repartidores_disponibles');//Muestra los repartidores disponibles dentro de un rango de fechas.
Route::post('/pedidos/asignar_repartidor','ServiciosController@asignar_repartidor');//Asigna un repartidor a un pedido.


/*-- Rutas para la subpestaña de información empresa --*/
Route::get('/configuracion/info_empresa','ConfiguracionController@info_empresa');//Carga la vista para la información de la empresa.
Route::post('/configuracion/info_empresa/guardar','ConfiguracionController@guardar_info_empresa');//Guarda la información de la empresa.
Route::post('/configuracion/info_empresa/editar','ConfiguracionController@editar_info_empresa');//Edita la información de la empresa.

/*-- Rutas para la pestaña cargar imagenes --*/
Route::get('/cargar_imagenes','ImagenController@index');//Carga el formulario de dropzone para cargar imagenes
Route::post('/subir_imagenes','ImagenController@subir_imagenes');//Carga las imágenes al servidor

/*-- Rutas para la pestaña de galería --*/
Route::get('/galeria','ImagenController@cargar_galeria');//Carga el login de ionic
Route::post('/galeria/eliminar', 'ImagenController@eliminar_galeria');//Da de baja un usuario

/*-- google analytics --*/
Route::get('/data','estadosController@analytics');//Devuelve los datos de google analytics

/**
 *===========================================================================================================================================================
 *=                                               Empiezan las rutas relacionadas a la api para la aplicación                                               =
 *===========================================================================================================================================================
 */

Route::group(['prefix' => 'app'], function () {
	#Rutas de pagos
	Route::post('validar_cargo','dataAppController@crear_cliente');//Crea un cliente
	Route::post('validar_cargo_efectivo','dataAppController@crear_pedido_efectivo');//Crea un pedido en efectivo.

	#Rutas para la aplicación
	Route::post('registro_usuario','dataAppController@registro_app');//Registra un usuario en la aplicación.
	Route::post('login/cliente','dataAppController@login_app_cliente');//Valida el inicio de sesión de un usuario cliente en la aplicación.
	Route::post('login/repartidor','dataAppController@login_app_repartidor');//Valida el inicio de sesión de un usuario repartidor en la aplicación.
	Route::post('actualizar_usuario','dataAppController@actualizar_datos_usuario');//Actualiza los datos del usuario a excepción de la contraseña, email y foto.
	Route::post('actualizar_contra','dataAppController@actualizar_password_usuario');//Actualiza los datos del usuario a excepción de la contraseña, email y foto.
	Route::post('recuperar_contra','dataAppController@recuperar_contra');//Envía una contraseña nueva generada automáticamente al correo del usuario.
	Route::post('actualizar_foto','dataAppController@actualizar_foto');//Actualiza la foto de perfil de un usuario.
	Route::post('agregar_direccion','dataAppController@agregar_direccion_usuario_app');//Agrega una dirección para el usuario.
	Route::post('actualizar_direccion','dataAppController@actualizar_direccion_usuario_app');//Actualiza una dirección del usuario.
	Route::post('listar_direcciones','dataAppController@listar_direcciones');//Muestra una lista de todas las direcciones del usuario de la aplicación.
	Route::post('eliminar_direccion','dataAppController@eliminar_direccion_usuario_app');//Elimina una dirección del usuario de la aplicación.
	Route::post('calificar_servicio','dataAppController@calificar_servicio');//Califica un servicio y lo marca como terminado.
	Route::post('liberar_pedido','dataAppController@liberar_pedido');//Termina un pedido a través del código de liberación en caso de ser correcto.
	Route::get('productos_categoria','dataAppController@productos_categoria');//Regresa todos los productos enlistados por categorias.
	Route::get('preguntas_frecuentes','dataAppController@obtener_preguntas_frecuentes');//Regresa todas las preguntas frecuentes de la aplicación.
	Route::post('obtener_pedidos_repartidor','dataAppController@obtener_pedidos_repartidor');//Devuelve los pedidos asignados a un repartidor.
	Route::post('obtener_pedidos_usuario','dataAppController@obtener_pedidos_usuario');//Devuelve los pedidos del usuario hechas desde la aplicación.

	#rutas para los favoritos
	Route::post('guardar_pedido_favoritos','dataAppController@guardar_pedido_favoritos');//Guarda un pedido como favorito y guarda sus detalles.
	Route::post('remover_pedido_favoritos','dataAppController@remover_pedido_favoritos');//Remueve un pedido como favorito y elimina también sus detalles.

	#Rutas de la app del repartidor
	Route::post('correo_solicitud','dataAppController@enviar_correo_solicitud_repartidor');//Envía un correo que envía datos de una persona que solicita ser repartidor de cocoinbox.
	Route::post('encaminar_pedido','dataAppController@encaminar_pedido');//Marca como activo un pedido y guarda las coordenadas del repartidor.
	Route::post('actualizar_coordenadas_repartidor','dataAppController@actualizar_coordenadas_repartidor');//Actualiza las coordenadas de un repartidor.
	Route::post('obtener_coordenadas_pedido','dataAppController@obtener_coordenadas_pedido');//Obtiene las coordenadas de un pedido.

	#Notificaciones con one signal
	Route::post('actualizar_player_id','dataAppController@actualizar_player_id');//Actualiza el player id de un usuario de la aplicación
	Route::post('enviar_notificacion_pedido_cercano','dataAppController@enviar_notificacion_pedido_cercano');//Envía una notificación individual a un usuario cliente que le indica que su pedido está a aproximadamente 100 metros de llegar.
});

