<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha pedido</th>
            <th>Total</th>
            <th>Cliente</th>
            <th class="hide">Repartidor id</th>
            <th>Repartidor</th>
            <th>Método de pago</th>
            <th>Status de compra</th>
            <th class="hide">Finalizado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($pedidos))
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{$pedido->id}}</td>
                    <td>{{$pedido->created_at}}</td>
                    <td>{{'$'.$pedido->costo_total/100}}</td>
                    <td>{{$pedido->cliente_nombre}}</td>
                    <td class="hide">{{$pedido->repartidor_id}}</td>
                    <td>
                        {!! ($pedido->repartidor_id ? "<span class='label label-warning'>$pedido->repartidor_nombre</span>" : "<span class='label label-important'>No asignado</span>") !!}
                    </td>
                    <td>
                        {!! ($pedido->tipo_pago == 'efectivo'? "<span class='label label-default'>Efectivo</span>" : "<span class='label label-info'>Tarjeta</span>") !!}
                    </td> 
                    <td>
                        {!! ($pedido->status == 'paid'? "<span class='label label-success'>Pagado</span>" : "<span class='label label-danger'>Pendiente a pagar</span>") !!}
                    </td>
                    <td class="hide">{{$pedido->is_finished}}</td>
                    <td>
                        @if(!isset($remove_button))
                            <button type='button' class='btn btn-success asignar_repartidor'>
                                <i class="fa fa-bicycle" aria-hidden="true"></i>
                                <i class="fa fa-spinner fa-spin" style="display: none"></i>
                                Repartidor
                            </button>
                        @endif
                        <button type="button" class="btn btn-info detalle_producto">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            Detalles
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>