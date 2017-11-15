@extends('admin.main')

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/> --}}
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
label.control-label{
    font-weight: bold;
}
table td.table-bordered{
    border-bottom: 1px solid gray!important;
    border-top: 1px solid gray!important;
}
span.label_show {
    display: block;
    font-weight: bold;
}
span.label_show span {
    font-weight: normal;
}
li.active{
    color: white;
}
</style>
<div class="text-center" style="margin: 20px;">

    @include('pedidos.modal_detalles')

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="asignar_repartidor_label" id="asignar-repartidor">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="asignar_repartidor_label">Asignar repartidor</h4>
                </div>
                <form id="form_asignar_repartidor" action="{{url('/pedidos/asignar_repartidor')}}" onsubmit="return false;" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Servicio ID</label>
                                    <input type="text" class="form-control" id="servicio_id" name="servicio_id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="repartidor_id">Repartidor</label>
                                    <select id="repartidor_id" name="repartidor_id" style="width:100%">
                                        <option value="0">Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-asignar-repartidor">
                            Asignar
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Listado de servicios {{isset($remove_button) ? 'finalizados' : 'activos'}}</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_pedidos">
                            @include('pedidos.table')
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
<script src="{{ asset('js/pedidosAjax.js') }}"></script>
<script type="text/javascript">

$.fn.modal.Constructor.prototype.enforceFocus = function() {};//Esto corrige que el select2 pueda funcionar apropiadamente
var token = $("#token").val();

$('body').delegate('.detalle_producto','click', function() {
    var pedido_id = $(this).parent().siblings("td:nth-child(1)").text();
    var status = $(this).parent().siblings("td:nth-child(9)").text();
    $('div#campos_detalles').addClass('hide');
    $('div#load_bar').removeClass('hide');
    $('#detalles_pedido').modal();
    obtenerInfoPedido(status,pedido_id,token);
});

$('body').delegate('.asignar_repartidor','click', function() {
    $("select#repartidor_id").val("0").trigger("change");
    $('tr').removeClass('modifiable');
    $(this).parent().parent().addClass('modifiable');
    var pedido_id = $(this).parent().siblings("td:nth-child(1)").text();
    var repartidor_id = $(this).parent().siblings("td:nth-child(5)").text();
    var btn = $(this);
    $('input#servicio_id').val(pedido_id);

    cargarRepartidoresSelect(pedido_id, repartidor_id, btn, token);
});

$('body').delegate('#btn-asignar-repartidor','click', function() {
    if ($('select#repartidor_id').val() != 0) {
        btn = $(this);
        btn.find('i.fa-spin').show();
        btn.attr('disabled', true);
        asignarRepartidor(btn);
    } else {
        swal({
            title: "<small>¡Error!</small>",
            type: "error",
            text: "Seleccione un repartidor antes de continuar",
            html: true
        });
    }
});

</script>
@endsection