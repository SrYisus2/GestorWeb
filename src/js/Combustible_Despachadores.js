$('#BtnGuardarDespachador').on('click', function (e) {
    e.preventDefault();
    var datos = new Array();
    var identificacion = $('#Identificacion').val();
    var nombre = $('#Nombre').val();
    var telefono = $('#Telefono').val();
    var op = 'insertar';

    datos.push(op, identificacion, nombre, telefono);

    if (!validaInputs(datos)) {
        $.post('back/Despachadores.php', { datos }, function (respuesta) {
            if (respuesta != 'NoConex') {
                if (respuesta) {
                    LimpiarCampos();
                    mensaje('top', 1600, 'success', 'Datos Guardados')
                    $('#tblDespachador').load('tables/tblDespachadores.php');
                } else {
                    mensaje('top', 1500, 'error', 'Datos no guardados')
                }
            } else {
                msgErrorConexion()
            }
        });
    }
    else {
        $('#identificacion').focus();
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Por favor',
            text: 'Complete todos los campos',
            showConfirmButton: true,
        });
    }
});

$('#BtnActualizarDespachador').on('click', function (e) {
    e.preventDefault();
    var datos = new Array();
    var id = $('#id').val();
    var identificacion = $('#Identificacion').val();
    var nombre = $('#Nombre').val();
    var telefono = $('#Telefono').val();
    var op = 'actualizar';

    datos.push(op, id, identificacion, nombre, telefono);
    if (!validaInputs(datos)) {
        $.post('back/Despachadores.php', { datos }, function (respuesta) {
            if (respuesta != 'NoConex') {
                if (respuesta) {
                    mensaje('top', 1500, 'success', 'Datos actualizados')

                    LimpiarCampos();
                    $('#BtnGuardarDespachador').removeClass('d-none');
                    $('#BtnActualizarDespachador').addClass('d-none');
                    $('#tblDespachador').load('../src/tables/tblDespachadores.php');
                } else {
                    mensaje('top', 1500, 'error', 'Datos no actualizados')
                }
            } else {
                msgErrorConexion()
            }
        });
    }
    else {
        $('#Identificacion').focus();
        mensaje('top', 1500, 'error', 'Complete todos los campos')
    }
});

function editarDespachador(id) {
    var datos = new Array();
    var op = 'buscar';
    datos.push(op, id);

    $.post('back/Despachadores.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            maq = JSON.parse(respuesta);
            $('#id').val(maq.id);
            $('#Identificacion').val(maq.identificacion);
            $('#Nombre').val(maq.nombre);
            $('#Telefono').val(maq.telefono);

            $('#BtnGuardarDespachador').addClass('d-none');
            $('#BtnActualizarDespachador').removeClass('d-none');
        } else {
            msgErrorConexion()
        }
    });
}

function eliminarDespachador(id) {
    var datos = new Array();
    var op = 'eliminar';
    datos.push(op, id);

    $.post('back/Despachadores.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            if (respuesta) {
                mensaje('top', 1500, 'success', 'Despachador deshabilitado')
                $('#tblDespachador').load('../src/tables/tblDespachadores.php');
            } else {
                mensaje('top', 1500, 'error', 'No se logró deshabilitar el despachador')
            }
        } else {
            msgErrorConexion()
        }
    });
}

function habilitarDespachador(id) {
    var datos = new Array();
    var op = 'habilitar';
    datos.push(op, id);

    $.post('back/Despachadores.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            if (respuesta) {
                mensaje('top', 1500, 'success', 'Despachador habilitado')
                $('#tblDespachador').load('../src/tables/tblDespachadores.php');
            } else {
                mensaje('top', 1500, 'error', 'No se logró habilitar el despachador')
            }
        } else {
            msgErrorConexion()
        }
    });
}

function LimpiarCampos() {
    $('#Identificacion').val("");
    $('#Nombre').val("");
    $('#Telefono').val("");
}