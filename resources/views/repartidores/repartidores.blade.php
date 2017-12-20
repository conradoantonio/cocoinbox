@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
th {
    text-align: center!important;
}
/* Cambia el color de fondo de los input con autofill */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="text-center" style="margin: 20px;">
    <h2>Lista de repartidores en la aplicación</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editar-repartidor">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Editar repartidor</h4>
                </div>
                <form id="form_repartidores" onsubmit="return false" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="alert alert-error hide" id="request-error">
                            <strong>Atención: </strong> El repartidor no ha sido guardado debido a que el correo otorgado no se encuentra disponible. Porfavor, intente con otro correo.
                        </div>
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="user_id">ID</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="repartidor_id">ID</label>
                                    <input type="text" class="form-control" id="repartidor_id" name="repartidor_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Nombre (s)</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Apellido (s)</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hide">
                                <div class="form-group">
                                    <label for="user">Correo viejo</label>
                                    <input type="text" class="form-control" id="correo_viejo" name="correo_viejo" placeholder="Correo viejo">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="user">Correo</label>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="comprobante_domicilio">Comprobante de domicilio
                                        <a class="document-read" id="com_dom_ext" href="" target="_blank" data-lightbox='roadtrip' data-title='Credencial de elector'>
                                            <span>
                                                <i data-toggle="tooltip" data-placement="down" title="Ver documento" class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </label>
                                    <input type="file" class="form-control" id="comprobante_domicilio" name="comprobante_domicilio">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="licencia">Licencia
                                        <a class="document-read" id="lic_ext" href="" target="_blank" data-lightbox='roadtrip' data-title='Credencial de elector'>
                                            <span>
                                                <i data-toggle="tooltip" data-placement="down" title="Ver documento" class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </label>
                                    <input type="file" class="form-control" id="licencia" name="licencia">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="solicitud_trabajo">Solicitud de trabajo
                                        <a class="document-read" id="sol_tra_ext" href="" target="_blank" data-lightbox='roadtrip' data-title='Credencial de elector'>
                                            <span>
                                                <i data-toggle="tooltip" data-placement="down" title="Ver documento" class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </label>
                                    <input type="file" class="form-control" id="solicitud_trabajo" name="solicitud_trabajo">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Credencial de elector 
                                        <a class="document-read" id="cre_ele_ext" href="" target="_blank" data-lightbox='roadtrip' data-title='Credencial de elector'>
                                            <span>
                                                <i data-toggle="tooltip" data-placement="down" title="Ver documento" class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </label>
                                    <input type="file" class="form-control" id="credencial_elector" name="credencial_elector">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar-datos-repartidor">
                            Guardar
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
                        
                        <button type="button" class="btn btn-info {{count($repartidores) ? '' : 'hide'}}" id="exportar_repartidores_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar repartidores (app)</button>
                        <button type="button" class="btn btn-primary" id="nuevo_repartidor_app"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo repartidor (app)</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla_repartidores">        
                            @include('repartidores.table')
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
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/validacionesRepartidores.js') }}"></script>
<script src="{{ asset('js/repartidoresAjax.js') }}"></script>
<script>
/*Código para cuando se ocultan los modal*/
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$('#editar-repartidor').on('hidden.bs.modal', function (e) {
    $('#editar-repartidor div.form-group').removeClass('has-error');
    $('input.form-control').val('');
    $('a.document-read').hide();

});
/*Fin de código para cuando se ocultan los modal*/

$('body').delegate('button#nuevo_repartidor_app','click', function() {
    $('#editar-repartidor div.form-group').removeClass('has-error');
    $("form#form_repartidores").get(0).setAttribute('action', '{{url('repartidores/guardar')}}');
    $('a.document-read').hide();
    $('input.form-control').val('');
    $("h4#gridSystemModalLabel").text('Nuevo repartidor');
    $('#editar-repartidor').modal();
});

$('body').delegate('.editar-repartidor','click', function() {
    $('#editar-repartidor div.form-group').removeClass('has-error');
    $('input.form-control').val('');
    $("form#form_repartidores").get(0).setAttribute('action', '{{url('repartidores/editar')}}');
    user_id = $(this).parent().siblings("td:nth-child(1)").text(),
    nombre = $(this).parent().siblings("td:nth-child(2)").text(),
    apellido = $(this).parent().siblings("td:nth-child(3)").text(),
    correo = $(this).parent().siblings("td:nth-child(4)").text(),
    celular = $(this).parent().siblings("td:nth-child(5)").text(),
    //foto = $(this).parent().siblings("td:nth-child(6)").text(),
    //status = $(this).parent().siblings("td:nth-child(7)").text();
    repartidor_id = $(this).parent().siblings("td:nth-child(8)").text(),
    comprobante_domicilio = $(this).parent().siblings("td:nth-child(9)").text(),
    licencia = $(this).parent().siblings("td:nth-child(10)").text(),
    solicitud_trabajo = $(this).parent().siblings("td:nth-child(11)").text(),
    credencial_elector = $(this).parent().siblings("td:nth-child(12)").text(),

    com_dom_ext = comprobante_domicilio.slice(-3);
    lic_ext = licencia.slice(-3);
    sol_tra_ext = solicitud_trabajo.slice(-3);
    cre_ele_ext = credencial_elector.slice(-3);
    
    $('a#com_dom_ext').attr('href', '{{url('')}}'+'/'+comprobante_domicilio);
    $('a#lic_ext').attr('href', '{{url('')}}'+'/'+licencia);
    $('a#sol_tra_ext').attr('href', '{{url('')}}'+'/'+solicitud_trabajo);
    $('a#cre_ele_ext').attr('href', '{{url('')}}'+'/'+credencial_elector);

    verificarDocumentos($('a#com_dom_ext'), com_dom_ext, 'Comprobante de domicilio');
    verificarDocumentos($('a#lic_ext'), lic_ext, 'Licencia');
    verificarDocumentos($('a#sol_tra_ext'), sol_tra_ext, 'Solicitud de trabajo');
    verificarDocumentos($('a#cre_ele_ext'), cre_ele_ext, 'Credencial de elector');

    $("#editar-repartidor input#user_id").val(user_id);
    $("#editar-repartidor input#repartidor_id").val(repartidor_id);
    $("#editar-repartidor input#nombre").val(nombre);
    $("#editar-repartidor input#apellido").val(apellido);
    $("#editar-repartidor input#correo").val(correo);
    $("#editar-repartidor input#correo_viejo").val(correo);
    $("#editar-repartidor input#celular").val(celular);

    $('#editar-repartidor').modal();
});

$('body').delegate('.eliminar-repartidor, .bloquear-repartidor, .reactivar-repartidor','click', function() {
    var repartidor = $(this).parent().siblings("td:nth-child(2)").text();
    var status = $(this).attr("change-to");
    var correo = $(this).parent().siblings("td:nth-child(4)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    var mensajeStatus = (status == '0' ? 'borrar' :  (status == '1' ? 'reactivar' : (status == '2' ? 'bloquear' : '')))

    swal({
        title: "¿Realmente desea " + mensajeStatus + " al repartidor " + "<span style='color:#F8BB86'>" + repartidor + "</span>?",
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
        eliminarBloquearRepartidor(id,status,correo,token);
    });
});

function verificarDocumentos(selector, ext, titulo) {
    if (ext == 'jpg' || ext == 'png' || ext == 'peg' || ext == 'gif') {//Imagen, se compara con peg, porque se entiende que puede ser un archivo jpeg
        selector.removeAttr('target');
        selector.attr('data-lightbox', 'roadtrip');
        selector.attr('data-title', titulo);
        selector.show();
    } else if (ext == 'pdf') {//Archivo pdf
        selector.attr('target', '_blank');
        selector.removeAttr('data-lightbox');
        selector.removeAttr('data-title');
    }
}
</script>
@endsection