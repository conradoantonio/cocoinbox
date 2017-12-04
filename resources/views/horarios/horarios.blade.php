@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css')}}"  type="text/css" media="screen"/>

<div class="text-center" style="margin: 20px;">

    <h2>Horarios</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                        <form id="form_horario" action="{{url('horarios/editar')}}" enctype="multipart/form-data" method="POST" autocomplete="off">
                            <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario domingo</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="domingo_id">domingo ID</label>
                                        <input type="text" class="form-control" id="domingo_id" name="domingo_id" value="{{$horarios->domingo->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="domingo_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="domingo_inicio" name="domingo_inicio" value="{{$horarios->domingo->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="domingo_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="domingo_final" name="domingo_final" value="{{$horarios->domingo->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="domingo_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="domingo_abierto" name="domingo_abierto" type="checkbox" {{$horarios->domingo->status == 1 ? 'checked' : ''}}>
                                            <label for="domingo_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario lunes</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="lunes_id">lunes ID</label>
                                        <input type="text" class="form-control" id="lunes_id" name="lunes_id" value="{{$horarios->lunes->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="lunes_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="lunes_inicio" name="lunes_inicio" value="{{$horarios->lunes->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="lunes_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="lunes_final" name="lunes_final" value="{{$horarios->lunes->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="lunes_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="lunes_abierto" name="lunes_abierto" type="checkbox" {{$horarios->lunes->status == 1 ? 'checked' : ''}}>
                                            <label for="lunes_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario martes</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="martes_id">martes ID</label>
                                        <input type="text" class="form-control" id="martes_id" name="martes_id" value="{{$horarios->martes->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="martes_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="martes_inicio" name="martes_inicio" value="{{$horarios->martes->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="martes_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="martes_final" name="martes_final" value="{{$horarios->martes->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="martes_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="martes_abierto" name="martes_abierto" type="checkbox" {{$horarios->martes->status == 1 ? 'checked' : ''}}>
                                            <label for="martes_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario miércoles</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="miercoles_id">miercoles ID</label>
                                        <input type="text" class="form-control" id="miercoles_id" name="miercoles_id" value="{{$horarios->miercoles->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="miercoles_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="miercoles_inicio" name="miercoles_inicio" value="{{$horarios->miercoles->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="miercoles_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="miercoles_final" name="miercoles_final" value="{{$horarios->miercoles->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="miercoles_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="miercoles_abierto" name="miercoles_abierto" type="checkbox" {{$horarios->miercoles->status == 1 ? 'checked' : ''}}>
                                            <label for="miercoles_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario jueves</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="jueves_id">jueves ID</label>
                                        <input type="text" class="form-control" id="jueves_id" name="jueves_id" value="{{$horarios->jueves->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="jueves_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="jueves_inicio" name="jueves_inicio" value="{{$horarios->jueves->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="jueves_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="jueves_final" name="jueves_final" value="{{$horarios->jueves->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="jueves_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="jueves_abierto" name="jueves_abierto" type="checkbox" {{$horarios->jueves->status == 1 ? 'checked' : ''}}>
                                            <label for="jueves_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario viernes</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="miercoles_id">viernes ID</label>
                                        <input type="text" class="form-control" id="viernes_id" name="viernes_id" value="{{$horarios->viernes->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="viernes_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="viernes_inicio" name="viernes_inicio" value="{{$horarios->viernes->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="viernes_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="viernes_final" name="viernes_final" value="{{$horarios->viernes->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="viernes_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="viernes_abierto" name="viernes_abierto" type="checkbox" {{$horarios->viernes->status == 1 ? 'checked' : ''}}>
                                            <label for="viernes_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                    <div class="form-group">
                                        <h4>Horario sábado</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="miercoles_id">sábado ID</label>
                                        <input type="text" class="form-control" id="sabado_id" name="sabado_id" value="{{$horarios->sabado->id}}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="sabado_inicio">Hora inicio</label>
                                        <input type="text" class="form-control timepicker" id="sabado_inicio" name="sabado_inicio" value="{{$horarios->sabado->hora_inicio}}" placeholder="Ej. 08:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 clockpicker">
                                    <div class="form-group">
                                        <label for="sabado_final">Hora final</label>
                                        <input type="text" class="form-control timepicker" id="sabado_final" name="sabado_final" value="{{$horarios->sabado->hora_fin}}" placeholder="Ej. 22:30">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12" style="padding-bottom: 20px;">
                                    <label for="sabado_abierto">Abierto</label>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary">
                                            <input id="sabado_abierto" name="sabado_abierto" type="checkbox" {{$horarios->sabado->status == 1 ? 'checked' : ''}}>
                                            <label for="sabado_abierto" style="padding-left:0px;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="guardar_horario">
                                <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                Guardar
                            </button>
                        </form>
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
<script src="{{ asset('plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
{{-- <script src="{{ asset('js/horariosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesHorarios.js') }}"></script> --}}
<script type="text/javascript">
/**
 *=============================================================================================================================================
 *=                                        Empiezan las funciones relacionadas a la tabla de horarios                                        =
 *=============================================================================================================================================
 */
</script>
@endsection