$('#BtnModalDespachador').click(function (e) {
    e.preventDefault();
    $('#ModalDespa').load('tables/Tbl_ModalDespachadores.php');
});

$(document).on('click', '#BtnAgregarDespachador', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    fila = Tbl_ModalDespachador.fnGetData(r);

    $("#idDespachador").val(fila[1]);
    $("#Despachador").val(fila[3]);
});

$('#BtnGuardarCombustible').click(function (e) {
    e.preventDefault();
    var datos = new Array();
    var fecha = $('#Fecha').val();
    var boleta = $('#boleta').val();
    var cantidadLts = $('#cantidadLts').val();
    var idDespachador = $('#idDespachador').val();
    var op = 'insertar';

    datos.push(op, fecha, boleta, cantidadLts, idDespachador);

    if (!validaInputs(datos)) {
        $.post('back/Combustible.php', { datos }, function (respuesta) {
            if (respuesta != 'NoConex') {
                if (respuesta) {
                    LimpiarCampos();
                    mensaje('top', 1600, 'success', 'Datos Guardados')
                    $('#Tbl_CombRegistro').load('tables/tblCombustible.php');
                } else {
                    mensaje('top', 1500, 'error', 'Datos no guardados')
                }
            } else {
                erroConexion()
            }
        });
    }
    else {
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Por favor',
            text: 'Complete todos los campos',
            showConfirmButton: true,
        });
    }
});

function eliminarCombustible(id) {
    var datos = new Array();
    var op = 'eliminar';
    datos.push(op, id);

    $.post('back/Combustible.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            if (respuesta) {
                mensaje('top', 1500, 'success', 'Datos eliminados')
                $('#Tbl_CombRegistro').load('tables/tblCombustible.php');
            }
        } else {
            msgErrorConexion()
        }
    });
}

function LimpiarCampos() {
    $('#Fecha').val("");
    $('#boleta').val("");
    $('#cantidadLts').val("");
    $('#despachador').val("");
}