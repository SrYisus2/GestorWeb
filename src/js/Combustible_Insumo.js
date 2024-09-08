$('#BtnModalMaquinaria').click(function (e) {
    e.preventDefault();
    $('#ModalMaq').load('tables/Tbl_ModalMaquinaria.php');
});

$('#BtnModalBoletaComb').click(function (e) {
    e.preventDefault();
    $('#ModalBoletaComb').load('tables/Tbl_ModalIngresoCombustible.php');
});

$('#BtnModalDespachador').click(function (e) {
    e.preventDefault();
    $('#ModalDespa').load('tables/Tbl_ModalDespachadores.php');
});

$(document).on('click', '#BtnAgregarMaquina', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    fila = Tbl_ModalMaquinaria.fnGetData(r);

    $("#idMaquina").val(fila[1]);
    $("#Maquina").val(fila[2]);
});

$(document).on('click', '#BtnAgregarDespachador', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    fila = Tbl_ModalDespachador.fnGetData(r);

    $("#idDespachador").val(fila[1]);
    $("#Despachador").val(fila[3]);
});

$(document).on('click', '#BtnAgregarBoletaComb', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    fila = Tbl_ModalIngresoCombustible.fnGetData(r);

    $("#idBoletaComb").val(fila[1]);
    $("#BoletaComb").val(fila[3]);
    $('#ModalBoletaComb').load('tables/Tbl_ModalIngresoCombustible.php');
});

$(document).on('click', '#BtnGuardarInsumo', function (e) {
    e.preventDefault();
    var datos = new Array();
    var Fecha = $("#Fecha").val();
    var BoletaDesp = $("#Boleta").val();
    var idMaquina = $("#idMaquina").val();
    var CantidadLts = $("#Cantidad").val();
    var idBoletaComb = $("#idBoletaComb").val();
    var idDespachador = $("#idDespachador").val();
    var op = 'buscar';

    datos.push(op, idBoletaComb, CantidadLts);

    if (!validaInputs(datos)) {
        $.post('back/Combustible_Insumo.php', { datos }, function (respuesta) {
            if (respuesta != 'NoConex') {
                if (respuesta) {
                    op = 'insertar';
                    iniciarArray(datos)
                    datos.push(op, Fecha, BoletaDesp, idMaquina, CantidadLts, idBoletaComb, idDespachador);

                    if (!validaInputs(datos)) {
                        $.post('back/Combustible_Insumo.php', { datos }, function (respuesta) {
                            if (respuesta != 'NoConex') {
                                if (respuesta) {
                                    LimpiarCampos();
                                    mensaje('top', 1600, 'success', 'Datos Guardados')
                                    $('#Tbl_insumoComb').load('tables/tblCombustible_insumos.php');
                                } else {
                                    mensaje('top', 1600, 'error', 'Datos no guardados')
                                }
                            } else {
                                msgErrorConexion()
                            }
                        });
                    } else {
                        msgError('Por favor', 'Complete todos los campos');
                    }
                } else {
                    $("#BoletaComb").focus();
                    mensaje('top', 1600, 'error', 'Boleta no tiene saldo suficiente');
                }
            } else {
                msgErrorConexion();
            }
        });
    }
    else {
        msgError('Por favor', 'Complete todos los campos');
    }
});

function eliminarInsumo(id, idCombustible, cantidadlts) {
    var datos = new Array();
    var op = 'eliminar';

    datos.push(op, id, idCombustible, cantidadlts);

    $.post('back/Combustible_Insumo.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            if (respuesta) {
                mensaje('top', 1600, 'success', 'Datos eliminados')
                $('#Tbl_insumoComb').load('tables/tblCombustible_insumos.php');
            } else {
                mensaje('top', 1500, 'error', 'Datos no eliminados')
            }
        } else {
            msgErrorConexion()
        }
    });
};

function LimpiarCampos() {
    $("#Boleta").val('');
    $("#Maquina").val('');
    $("#Cantidad").val('');
    $("#BoletaComb").val('');
    $("#Despachador").val('');
    $("#idDespachador").val('');
}