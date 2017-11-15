<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/cargar/quienes_somos',//Se puso aquí porque daba error al subir archivos de más de 6 mb.
        //Principio de los de conekta prueba
        '/post_send',
        '/cargar/codigo_postal',
        '/crear_cliente',
        '/app/validar_cargo',
        '/app/validar_cargo_oxxo',
        '/app/validar_cargo_efectivo',
        '/procesar_orden',
        '/app/orden_empresa',
        //Fin de los de conekta prueba
        '/productos/cargar_subcategorias',
        '/subir_imagenes',
        '/app/registro_usuario',
        '/app/login/cliente',
        '/app/login/repartidor',
        '/app/usuario/cargar_imagen',
        '/app/actualizar_usuario',
        '/app/recuperar_contra',
        '/app/actualizar_foto',
        '/app/agregar_direccion',
        '/app/actualizar_direccion',
        '/app/eliminar_direccion',
        '/app/listar_direcciones',
        '/app/quienes_somos',
        '/app/info_empresas',
        '/app/preguntas_frecuentes',
        '/app/obtener_pedidos_usuario',
        '/app/guardar_pedido_favoritos',
        '/app/remover_pedido_favoritos',
        '/app/obtener_pedidos_repartidor',
        '/app/obtener_cotizaciones_usuario',
        '/app/enviar_correo_detalle_orden',
        '/app/enviar_correo_detalle_cotizacion',
        '/app/calificar_servicio',
        '/app/liberar_pedido',
        '/app/actualizar_contra',
        '/app/encaminar_pedido',
        '/app/actualizar_coordenadas_repartidor',
        '/app/obtener_coordenadas_pedido',
        '/app/actualizar_player_id',
    ];
}
