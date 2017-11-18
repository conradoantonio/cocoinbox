/*Código para validar el formulario de datos del usuario*/
var inputs = [];
mb = 0;
fileExtension = ['jpg', 'jpeg', 'png'];
var msgError = '';
var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
var regExprNum = /^[\d .]{1,}$/i;
var btn_enviar_producto = $("#guardar_producto");
btn_enviar_producto.on('click', function() {
    inputs = [];
    msgError = '';

    validarInput($('input#nombre'), regExprTexto) == false ? inputs.push('Nombre') : ''
    validarInput($('input#precio'), regExprNum) == false ? inputs.push('Precio') : ''
    validarInput($('textarea#descripcion'), regExprTexto) == false ? inputs.push('Descripción') : ''
    validarSelect($('select#categoria_id')) == false ? inputs.push('Categoría') : ''
    validarInput($('input#gramos_base'), regExprNum) == false ? inputs.push('Gramos base') : ''
    validarInput($('input#cantidad_porcion'), regExprNum) == false ? inputs.push('Porción') : ''
    validarInput($('input#precio_porcion'), regExprNum) == false ? inputs.push('Precio por porción') : ''
    validarInput($('input#precio_chico'), regExprNum) == false ? inputs.push('Precio bebida chica') : ''
    validarInput($('input#precio_grande'), regExprNum) == false ? inputs.push('Precio bebida grande') : ''
    validarArchivo($('input#foto')) == false ? inputs.push('Imagen') : ''

    if (inputs.length == 0) {
        $(this).children('i').show();
        $(this).attr('disabled', true);
        subirProducto($(this));
    } else {
        swal("Corrija los siguientes campos para continuar: ", msgError);
        return false;
    }
});

$( "input#nombre" ).blur(function() {
    validarInput($(this), regExprTexto);
});
$( "input#precio" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "select#categoria_id" ).change(function() {
    validarSelect($(this));
});
$( "input#gramos_base" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#cantidad_porcion" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#precio_porcion" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#precio_chico" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "input#precio_grande" ).blur(function() {
    validarInput($(this), regExprNum);
});
$( "textarea#descripcion" ).blur(function() {
    validarInput($(this), regExprTexto);
});

function validarInput (campo,regExpr) {
    if (!$(campo).is(":visible")) {
        return true;
    } else if (!$(campo).val().match(regExpr)) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}

function validarSelect (select) {
    if ($(select).val() == '0' || $(select).val() == '' || $(select).val() == null) {
        $(select).parent().addClass("has-error");
        msgError = msgError + $(select).parent().children('label').text() + '\n';
        return false;
    } else {
        $(select).parent().removeClass("has-error");
        return true;
    }
}

$('#form_producto input#foto').bind('change', function() {
    if ($(this).val() != '') {

        kilobyte = (this.files[0].size / 1024);
        mb = kilobyte / 1024;

        archivo = $(this).val();
        extension = archivo.split('.').pop().toLowerCase();

        if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
            swal({
                title: "Archivo no válido",
                text: "Debe seleccionar una imágen con formato jpg, jpeg o png, y debe pesar menos de 5MB",
                type: "error",
                closeOnConfirm: false
            });
        }
    }
});

function validarArchivo(campo) {
    archivo = $(campo).val();
    extension = archivo.split('.').pop().toLowerCase();

    if($('form#form_producto input#id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
        return true;
    } else if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
        $(campo).parent().addClass("has-error");
        msgError = msgError + $(campo).parent().children('label').text() + '\n';
        return false;
    } else {
        $(campo).parent().removeClass("has-error");
        return true;
    }
}

/*Fin de código para validar el formulario de datos del usuario*/

/*Código para validar el archivo que importa datos desde excel*/
var btn_enviar_excel = $("#enviar-excel");
btn_enviar_excel.on('click', function() {
    fileExtension = ['xls', 'xlsx'];
    archivo = $("#archivo-excel").val();
    extension = archivo.split('.').pop().toLowerCase();

    if ($.inArray(extension, fileExtension) == -1) {
        swal({
            title: "Error",
            text: "<span>Solo son admitidos archivos con extensión <strong>xls y xlsx</strong><br>Extensión de archivo seleccionado: <strong>"+ extension +" </strong></span>",
            type: "error",
            html: true,
            confirmButtonColor: "#286090",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
        });
        return false;
    } else {
        $(this).children('i').show();
        $(this).attr('disabled', true);
        cargarExcelPlatillos(btn_enviar_excel);
    }
});
/*Fin del código para validar el archivo que importa datos desde excel*/