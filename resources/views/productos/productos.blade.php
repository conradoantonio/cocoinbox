@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
.table td.text {
    max-width: 177px;
}
.table td.text span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
    max-width: 100%;
}
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_producto" id="formulario_producto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_producto">Nuevo platillo</h4>
                </div>
                <form id="form_producto" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="categoria_id">Categoría</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id">
                                        <option value="0">Seleccione una opción</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12" id="div_precio">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" id="div_cantidad_porcion">
                                <div class="form-group">
                                    <label for="cantidad_porcion">Cantidad de porción (en gr)</label>
                                    <input type="text" class="form-control" id="cantidad_porcion" name="cantidad_porcion" placeholder="Mayor a 100gr y menor que 2000gr">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" id="div_precio_porcion">
                                <div class="form-group">
                                    <label for="precio_porcion">Precio de cada porción</label>
                                    <input type="text" class="form-control" id="precio_porcion" name="precio_porcion" placeholder="Precio de cada porción">
                                </div>
                            </div>
                            {{-- Input para las bebidas ocultos --}}
                            <div class="col-sm-6 col-xs-12" id="div_precio_chico">
                                <div class="form-group">
                                    <label for="precio_chico">Precio bebida chica</label>
                                    <input type="text" class="form-control" id="precio_chico" name="precio_chico" placeholder="Precio bebida chica">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12" id="div_precio_grande">
                                <div class="form-group">
                                    <label for="precio_grande">Precio bebida grande</label>
                                    <input type="text" class="form-control" id="precio_grande" name="precio_grande" placeholder="Precio bebida grande">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-dismissible text-left" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Nota: </strong>
                                    Solo se permiten subir imágenes con formato jpg, png, jpeg y gif con un tamaño menor a 5mb. 
                                    Procure que su resolución sea de 340x355 px o su equivalente a escala.
                                </div>
                            </div>
                            <div id="input_foto_producto" class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="foto_producto">Foto platillo</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="foto_producto">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_producto">
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de platillos</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="importar-excel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Importar platillos desde Excel</h4>
                </div>
                <form method="POST" onsubmit="return false" action="{{url('productos/importar_productos')}}" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="alert alert-info alert-dismissible text-justify" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Instrucciones de uso: </strong><br>
                                    Para importar platillos a través de Excel, los datos deben estar acomodados como se describe a continuación: <br>
                                    Los campos de la primera fila de la hoja de excel deben de ir los campos llamados 
                                    <strong>"nombre, descripcion, precio, cantidad_porcion, precio_porcion, categoria, foto"</strong>, posteriormente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de los productos.
                                    <br><strong>Nota: </strong>
                                    <br>- Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd> y los platillos repetidos en el excel no serán creados.
                                    <br>- Esta acción puede llevar hasta 1 minuto, porfavor espere y permanezca en esta ventana hasta que un mensaje sea mostrado en su pantalla.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input class="form-control" type="file" id="archivo-excel" name="archivo-excel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="enviar-excel">
                            Importar
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-info {{count($productos) ? '' : 'hide'}}" id="exportar_productos_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar platillos</button>
                        <button type="button" class="btn btn-danger {{count($productos) ? '' : 'hide'}}" id="eliminar_multiples_productos"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar platillos</button>
                        
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importar-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar platillos</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo platillo</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_productos">
                            @include('productos.tabla')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/productosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesProductos.js') }}"></script>
<script type="text/javascript">
/**
 *=============================================================================================================================================
 *=                                        Empiezan las funciones relacionadas a la tabla de productos                                        =
 *=============================================================================================================================================
 */

 $( "select#categoria_id" ).change(function() {
    cat_id = $(this).val();
    $('div#div_precio, div#div_cantidad_porcion, div#div_precio_porcion, div#div_precio_chico, div#div_precio_grande').hide();

    activarCampos(cat_id);
});

$('#formulario_producto').on('hidden.bs.modal', function (e) {
    $('#formulario_producto div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $("#formulario_producto input#oferta").prop('checked',false);
});

$('#formulario_producto').on('shown.bs.modal', function () {
    categoria_id = $('select#subcategoria_id').attr('categoria-id');
    $("#formulario_producto select#subcategoria_id").val(categoria_id);
});

$('body').delegate('button#exportar_productos_excel','click', function() {
    fecha_inicio = false;
    fecha_fin = false;
    window.location.href = "<?php echo url();?>/productos/exportar_productos/"+fecha_inicio+"/"+fecha_fin;
});

$('body').delegate('button#nuevo_producto','click', function() {
    $('div#div_precio, div#div_cantidad_porcion, div#div_precio_porcion, div#div_precio_chico, div#div_precio_grande').hide();
    $('select.form-control').val(0);
    $('input.form-control').val('');
    $('div#foto_producto').hide();
    $("h4#titulo_form_producto").text('Nuevo platillo');
    $("form#form_producto").get(0).setAttribute('action', '<?php echo url();?>/productos/guardar');
});

$('body').delegate('.editar_producto','click', function() {
    $('div#div_precio, div#div_cantidad_porcion, div#div_precio_porcion, div#div_precio_chico, div#div_precio_grande').hide();
    $('input.form-control').val('');
    id = $(this).parent().siblings("td:nth-child(2)").text(),
    nombre = $(this).parent().siblings("td:nth-child(3)").text(),
    precio = $(this).parent().siblings("td:nth-child(4)").text(),
    descripcion = $(this).parent().siblings("td:nth-child(5)").text(),
    categoria_id = $(this).parent().siblings("td:nth-child(6)").text(),
    precio_porcion = $(this).parent().siblings("td:nth-child(7)").text(),
    cantidad_porcion = $(this).parent().siblings("td:nth-child(8)").text(),
    precio_chico = $(this).parent().siblings("td:nth-child(9)").text(),
    precio_grande = $(this).parent().siblings("td:nth-child(10)").text(),
    imagen = $(this).parent().siblings("td:nth-child(11)").text(),
    token = $('#token').val();

    activarCampos(categoria_id);

    $("h4#titulo_form_producto").text('Editar platillo');
    $("form#form_producto").get(0).setAttribute('action', '<?php echo url();?>/productos/editar');
    $("#formulario_producto input#id").val(id);
    $("#formulario_producto input#nombre").val(nombre);
    $("#formulario_producto input#precio").val(precio);
    $("#formulario_producto input#precio_porcion").val(precio_porcion);
    $("#formulario_producto input#cantidad_porcion").val(cantidad_porcion);
    $("#formulario_producto input#precio_chico").val(precio_chico);
    $("#formulario_producto input#precio_grande").val(precio_grande);
    $("#formulario_producto textarea#descripcion").val(descripcion);
    $("#formulario_producto select#categoria_id").val(categoria_id);

    $('div#foto_producto').children().children().children().remove('img#foto_producto');
    $('div#foto_producto').children().children().append(
        "<img src='<?php echo asset('');?>/"+imagen+"' class='img-responsive img-thumbnail' alt='Responsive image' id='foto_producto'>"
    );
    $("div#foto_producto").show();

    $('#formulario_producto').modal();
});

$('body').delegate('#eliminar_multiples_productos','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar los <span style='color:#F8BB86'>" + checking.length + "</span> platillos seleccionados?",
            text: "¡Esta acción no podrá deshacerse!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            var token = $("#token").val();
            eliminarMultiplesProductos(checking, token);
        });
    }
});


$('body').delegate('.eliminar_producto','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(3)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar el platillo <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarProducto(id,token);
    });
});

function activarCampos (cat_id) {
    if (cat_id == 4) {//Bebidas
        $('div#div_precio_chico, div#div_precio_grande').show();
        //$("input#precio_chico, input#precio_grande").val('');
    } else if (cat_id != 4 && cat_id != 0){//Proteina, carbohidratos, ensaladas
        $('div#div_precio, div#div_cantidad_porcion, div#div_precio_porcion').show();
        //$("input#cantidad_porcion, input#precio_porcion").val('');
    }
}
</script>
@endsection