<table class="table" id="example3">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Nombre</th>
            <th class="hide">Precio</th>
            <th class="">Descripción</th>
            <th class="hide">Categoria_id</th>
            <th class="hide">Precio porción</th>
            <th class="hide">Cantidad porción</th>
            <th class="hide">Precio bebida chica</th>
            <th class="hide">Precio bebida grande</th>
            <th class="hide">Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($productos) > 0)
            @foreach($productos as $producto)
                <tr class="" id="{{$producto->id}}">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input id="checkbox{{$producto->id}}" type="checkbox" class="checkDelete" value="1">
                            <label for="checkbox{{$producto->id}}"></label>
                        </div>
                    </td>
                    <td>{{$producto->id}}</td>
                    <td>{{$producto->nombre}}</td>
                    <td class="hide">{{$producto->precio}}</td>
                    <td class="text"><span>{{$producto->descripcion}}</span></td>
                    <td class="hide">{{$producto->categoria_id}}</td>
                    <td class="hide">{{$producto->precio_porcion}}</td>
                    <td class="hide">{{$producto->cantidad_porcion}}</td>
                    <td class="hide">{{$producto->precio_chico}}</td>
                    <td class="hide">{{$producto->precio_grande}}</td>
                    <td class="hide">{{$producto->foto_producto}}</td>
                    <td>
                        <button type="button" class="btn btn-info editar_producto">Editar</button>
                        <button type="button" class="btn btn-danger eliminar_producto">Borrar</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>