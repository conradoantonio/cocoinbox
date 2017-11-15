base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

function guardarPregunta(button) {
    var formData = new FormData($("form#form_preguntas")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_preguntas").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#editar_pregunta').modal('hide');
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            $('div#editar_pregunta').modal('hide');
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema guardando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarPregunta(id, token) {
    url = base_url.concat('/preguntas_frecuentes/eliminar_pregunta');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal.close();
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>Error!</small>",
                text: "Se encontró un problema eliminando la pregunta, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#div_tabla_preguntas').fadeOut();
    $('div#div_tabla_preguntas').empty();
    $('div#div_tabla_preguntas').load(url, function() {
        $('div#div_tabla_preguntas').fadeIn();
        $("table#example3").dataTable({
            "aaSorting": [[ 0, "desc" ]]
        });
    });
}
