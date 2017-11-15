@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
th {
    text-align: center!important;
}
textarea {
    resize: none;
}
.table td.text {
    max-width: 250px;
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
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_preguntas" id="editar_pregunta">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_preguntas">Editar pregunta</h4>
                </div>
                <form id="form_preguntas" action="" onsubmit="return false" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                        <div class="col-sm-6 col-xs-12 hidden">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="" id="id" name="id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tipo_pregunta_id">Categoría</label>
                                    <select class="form-control" id="tipo_pregunta_id" name="tipo_pregunta_id">
                                        <option value="0">Seleccione una opción</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="pregunta">Pregunta</label>
                                    <input type="text" class="form-control" id="pregunta" placeholder="Pregunta" name="pregunta">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="respuesta">Respuesta</label>
                                    <textarea class="form-control" id="respuesta" placeholder="Respuesta..." name="respuesta" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Cargar Imagen</label>
                                    <input type="file" name="imagen_pregunta" class="form-control" id="imagen_pregunta" size="5120">
                                </div>
                            </div>
                        </div>

                        <div class="row" id="imagen_pregunta">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Imagen Actual</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_pregunta">
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <h2>Lista de preguntas</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary" id="nueva_pregunta">Agregar pregunta</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_preguntas">
                            @include('configuracion.table')
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
<script src="{{ asset('js/validacionesPreguntas.js') }}"></script>
<script src="{{ asset('js/preguntasAjax.js') }}"></script> 
<script type="text/javascript">

$('#editar_pregunta').on('hidden.bs.modal', function (e) {
    $('#editar_pregunta div.form-group').removeClass('has-error');
    $('#guardar_pregunta').show();
})

$('body').delegate('#nueva_pregunta','click', function() {
    $('select.form-control').val(0);
    $("form#form_preguntas").get(0).setAttribute('action', '<?php echo url();?>/preguntas_frecuentes/guardar_pregunta');
    $('h4#titulo_form_preguntas').text('Nueva pregunta');
    $('select.form-control').val(0);
    $("#editar_pregunta input#id").val('');
    $("#editar_pregunta input#pregunta").val('');
    $("#editar_pregunta textarea#respuesta").val('');
    $("div#imagen_pregunta").hide();
    $('#editar_pregunta').modal();
});

$('body').delegate('.editar_pregunta','click', function() {
    $("form#form_preguntas").get(0).setAttribute('action', '<?php echo url();?>/preguntas_frecuentes/editar_pregunta');
    $('h4#titulo_form_preguntas').text('Editar pregunta');
    id = $(this).parent().siblings("td:nth-child(1)").text(),
    pregunta = $(this).parent().siblings("td:nth-child(2)").text(),
    respuesta = $(this).parent().siblings("td:nth-child(3)").text();
    imagen = $(this).parent().siblings("td:nth-child(4)").text();
    tipo_pregunta_id = $(this).parent().siblings("td:nth-child(5)").text();


    $("#editar_pregunta input#id").val(id);
    $("#editar_pregunta select#tipo_pregunta_id").val(tipo_pregunta_id);
    $("#editar_pregunta input#pregunta").val(pregunta);
    $("#editar_pregunta textarea#respuesta").val(respuesta);
    $('div#imagen_pregunta').children().children().children().remove('img#imagen_pregunta');
    $('div#imagen_pregunta').children().children().append(
        "<img src='<?php echo asset('');?>"+imagen+"' class='img-responsive img-thumbnail' alt='Responsive image' id='imagen_pregunta'>"
    );
    $("div#imagen_pregunta").show();

    $('#editar_pregunta').modal();
});

$('body').delegate('.eliminar_pregunta','click', function() {
    var pregunta_id = $(this).parent().siblings("td:nth-child(1)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar la pregunta con el id " + "<span style='color:#F8BB86'>" + pregunta_id + "</span>?",
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
        eliminarPregunta(id,token);
    });
});

</script>
@endsection