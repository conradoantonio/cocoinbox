<table class="table table-hover" id="example3">
    <thead class="centered">    
        <th>ID</th>
        <th>Pregunta</th>
        <th>Respuesta</th>
        <th class="hide">Imagen</th>
        <th class="hide">Tipo_id</th>
        <th class="">Categoría</th>
        <th>Acciones</th>
    </thead>
    <tbody id="" class="">
        @if(count($preguntas) > 0)                    
            @foreach($preguntas as $pregunta)
                <tr class="" id="{{$pregunta->id}}" idPueblo="{{$pregunta->id}}">
                    <td>{{$pregunta->id}}</td>
                    <td>{{$pregunta->pregunta}}</td>
                    <td class="text"><span>{{$pregunta->respuesta}}</span></td>
                    <td class="hide">{{$pregunta->imagen}}</td>
                    <td class="hide">{{$pregunta->tipo_pregunta_id}}</td>
                    <td class="">{{$pregunta->tipo}}</td>
                    <td>
                        <button type="button" class="btn btn-info editar_pregunta">Editar</button>
                        <button type="button" class="btn btn-danger eliminar_pregunta" status-pueblo="0">Borrar</button>
                    </td>
                </tr>
            @endforeach
        @endif  
    </tbody>
</table>