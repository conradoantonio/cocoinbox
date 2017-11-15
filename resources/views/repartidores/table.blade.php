<table class="table table-hover" id="example3">
    <thead class="centered">    
        <th>ID</th>
        <th>Nombre</th>
        <th class="hide">Apellido</th>
        <th>Correo</th>
        <th>Celular</th>
        <th class="hide">Foto perfil</th>
        <th>Status</th>
        <th class="hide">Repartidor ID</th>
        <th class="hide">Comprobante de domicilio</th>
        <th class="hide">Licencia</th>
        <th class="hide">Solicitud de trabajo</th>
        <th class="hide">Credencial de elector</th>
        <th>Acciones</th>
    </thead>
    <tbody id="tabla-repartidores-app" class="">
        @if($repartidores)
            @foreach($repartidores as $repartidor)
                <tr id="{{$repartidor->usuario_id}}">
                    <td>{{$repartidor->usuario_id}}</td>
                    <td>{{$repartidor->nombre}}</td>
                    <td class="hide">{{$repartidor->apellido}}</td>
                    <td>{{$repartidor->correo}}</td>
                    <td>{{$repartidor->celular}}</td>
                    <td class="hide">{{$repartidor->foto_perfil}}</td>
                    <td><?php echo $repartidor->status == '2' ? '<span class="label label-warning">Bloqueado</span>' : ($repartidor->status == '1' ? '<span class="label label-success">Activo</span>' : '<span class="label label-info">Desconocido</span>')?></td>
                    <td class="hide">{{$repartidor->repartidor_id}}</td>
                    <td class="hide">{{$repartidor->comprobante_domicilio}}</td>
                    <td class="hide">{{$repartidor->licencia}}</td>
                    <td class="hide">{{$repartidor->solicitud_trabajo}}</td>
                    <td class="hide">{{$repartidor->credencial_elector}}</td>
                    <td>
                        @if($repartidor->status == '1')
                            <button type="button" class="btn btn-info editar-repartidor" change-to="">Editar</button>
                            <button type="button" class="btn btn-warning bloquear-repartidor" change-to="2">Bloquear</button>
                            <button type="button" class="btn btn-danger eliminar-repartidor" change-to="0">Borrar</button>
                        @endif
                        
                        @if($repartidor->status == '2')
                            <button type="button" class="btn btn-primary reactivar-repartidor" change-to="1">Reactivar</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif  
    </tbody>
</table>