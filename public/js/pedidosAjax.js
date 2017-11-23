base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function obtenerInfoPedido(status,pedido_id,token) {
    url = base_url.concat('/pedidos/obtener_info_pedido');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "status":status,
            "pedido_id":pedido_id,
            "_token":token
        },
        success: function(data) {
            console.info(data);

            $("table#detalle_pedido tbody").children().remove();
            $('li#li_repartidor_nombre_completo').hide();
            $('li#li_repartidor_foto').hide();

            var items = data.detalles;

            /*Datos generales*/
            $('span#order_id').text(data.id);
            $('span#order_id_conekta').text(setText($('span#order_id_conekta'), data.conekta_order_id));
            $('span#order_metodo_pago').html(data.tipo_pago == 'efectivo' ? "<span class='label label-default'>Efectivo</span>" : "<span class='label label-info'>Tarjeta</span>");
            $('span#order_status').html(data.status == 'paid' ? "<span class='label label-success'>Pagado</span>" : "<span class='label label-important'>Pendiente a pagar</span>");
            $('span#order_date').text(data.created_at);
            $('span#order_codigo_liberacion').text(data.codigo_liberacion);
            $('span#order_client').text(data.nombre_cliente);
            $('span#order_comentarios').text(setText($('span#order_comentarios'), data.comentarios));

            $('span#repartidor_nombre_completo').text(setText($('span#repartidor_nombre_completo'), data.repartidor_nombre)+ ' ' +data.repartidor_apellido);
            if (data.repartidor_nombre != null) {
                $('li#li_repartidor_foto').show();
                $("img#repartidor_foto").attr("src", baseUrl+'/'+data.repartidor_foto);
            }
            $('span#puntuacion').text(setText($('span#puntuacion'), data.puntuacion));
            
            /*Datos de contacto*/
            $('span#customer_id_conekta').text(setText($('span#customer_id_conekta'), data.customer_id_conekta));
            $('span#customer_name').text(data.nombre_cliente);
            $('span#customer_email').text(data.correo_cliente);
            $('span#customer_phone').text(data.telefono);

            /*Dirección*/
            $('span#recibidor').text(data.recibidor);
            $('span#phone').text(data.telefono);
            $('span#country').text(data.pais);
            $('span#state').text(data.estado);
            $('span#city').text(data.ciudad);
            $('span#postal_code').text(data.codigo_postal);
            $('span#street').text(data.calle);
            $('span#colony').text(data.colonia);
            $('span#no_int').text(setText($('span#no_int'), data.num_int));
            $('span#no_ext').text(data.num_ext);

            /*Detalles de pedido (Productos)*/
            for (var key in items) {
                if (items.hasOwnProperty(key)) {
                    var subtotal = (items[key].precio / 100) * items[key].cantidad;3
                    var subtotal_porciones = 0;
                    if (items[key].drink != 1) { 
                        if (items[key].porciones_adicionales != 0 && items[key].porciones_adicionales != "") {
                            subtotal_porciones = items[key].porciones_adicionales * items[key].precio_porcion * items[key].cantidad;
                        }
                    }

                    $("table#detalle_pedido tbody").append(
                        '<tr>'+
                            '<td class="text-center">'+items[key].nombre_producto+'</td>'+
                            '<td class="text-center">$'+(items[key].precio / 100)+'</td>'+
                            '<td class="text-center">'+(items[key].cantidad)+'</td>'+
                            '<td class="text-center">'+(items[key].drink != 1 ? '$'+items[key].precio_porcion : 'No aplica')+'</td>'+
                            '<td class="text-center">'+(items[key].drink != 1 ? (items[key].porciones_adicionales == "" ? '0' : items[key].porciones_adicionales) : 'No aplica')+'</td>'+
                            '<td class="text-center">'+(subtotal_porciones != 1 ? '$'+subtotal_porciones : 'Sin cargos adicionales')+'</td>'+
                            '<td class="text-center">$'+(subtotal + subtotal_porciones)+'</td>'+
                        '</tr>'
                    );
                }
            }

            $("table#detalle_pedido tbody").append(
                '<tr>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center bold">Costo total</td>'+
                    '<td class="text-center">$'+(data.costo_total/100)+'</td>'+
                '</tr>'
            );

            $('div#campos_detalles').removeClass('hide');
            $('div#load_bar').addClass('hide');
        },
        error: function(xhr, status, error) {
            $('#detalles_pedido').modal('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema obteniendo los detalles de este servicio, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function setText(selector, text) {
    if (text != null && text != '') {
        $(selector).parent().parent().show();
        return text;
    } else {
        $(selector).parent().parent().hide();
        return '';
    }
}

function asignarRepartidor(btn) {
    $.ajax({
        url:$("form#form_asignar_repartidor").attr('action'),
        type:$("form#form_asignar_repartidor").attr('method'),
        data:new FormData($("form#form_asignar_repartidor")[0]),
        processData: false,
        contentType: false,
        success:function(data) {
            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            $('#asignar-repartidor').modal('hide');

            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema asignado un repartidor a este servicio, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    })
}

function cargarRepartidoresSelect(orden_id, repartidor_id, btn, token) {
    btn.find('i.fa-scissors').hide();
    btn.find('i.fa-spin').show();
    btn.attr('disabled', true);
    url = base_url.concat('/pedidos/cargar_repartidores_disponibles');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "orden_id":orden_id,
            "repartidor_id":repartidor_id,
            "_token":token
        },
        success: function(data) {
            console.info(data);
            $('select#repartidor_id option').remove();
            $('select#repartidor_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
            
            data.forEach(function (option) {
                $('select#repartidor_id').append('<option value="'+option.id+'">'+ option.nombre + ' ' + option.apellido + '</option>');
            });

            btn.find('i.fa-scissors').show();
            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            $('#asignar-repartidor').modal();

        },
        error: function(xhr, status, error) {
            btn.find('i.fa-scissors').show();
            btn.find('i.fa-spin').hide();
            btn.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema cargando los repartidores disponibles, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
            
function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#div_tabla_pedidos').fadeOut();
    $('div#div_tabla_pedidos').empty();
    $('div#div_tabla_pedidos').load(url, function() {
        $('div#div_tabla_pedidos').fadeIn();
        $("table#example3").dataTable({
            "aaSorting": [[ 0, "desc" ]]
        });
    });
}