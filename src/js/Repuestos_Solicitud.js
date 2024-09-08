Tbl_SolicitudRepuesto = $('#Tbl_SolicitudRepuesto').dataTable({
    retrieve: true,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});

$('#BtnModalRepuestos').click(function (e) {
    e.preventDefault();
    $('#tblModalRepuestos').load('tables/Tbl_ModalRepuestos.php');
});

$('#BtnModalMaquinaria').click(function (e) {
    e.preventDefault();
    $('#tblModalMaquinaria').load('tables/Tbl_ModalMaquinaria.php');
});

$(document).on('click', '#BtnAgregarRepuesto', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    FilaModalRepuestos = tbl_ModalRepuestos.fnGetData(r);

    // PASA LOS DATOS A LOS INPUT DEL "FORMULARIO"
    $("#idCodRepuesto").val(FilaModalRepuestos[1]);
    $("#codRepuesto").val(FilaModalRepuestos[2]);
    $("#Descripcion").val(FilaModalRepuestos[3]);
    $("#Cantidad").focus();
});

$(document).on('click', '#BtnAgregarMaquina', function (e) {
    e.preventDefault();
    r = $(this).parent().parent()[0];
    FilaModalMaquina = Tbl_ModalMaquinaria.fnGetData(r);

    $("#idMaquina").val(FilaModalMaquina[1]);
    $("#Maquina").val(FilaModalMaquina[2]);
});

$(document).on('click', '#BtnAgregarLinea', function (e) {
    e.preventDefault();
    var datos = new Array();
    var Fecha = $("#Fecha").val();
    var idCodRepuesto = $("#idCodRepuesto").val();
    var codRepuesto = $("#codRepuesto").val();
    var Descripcion = $("#Descripcion").val();
    var Cantidad = $("#Cantidad").val();
    var idMaquina = $("#idMaquina").val();
    var Maquina = $("#Maquina").val();

    datos.push(Fecha, idCodRepuesto, codRepuesto, Descripcion, Cantidad, idMaquina, Maquina);

    if (!validaInputs(datos)) {
        Tbl_SolicitudRepuesto.fnAddData([
            Fecha, idCodRepuesto, codRepuesto, Descripcion, Cantidad, idMaquina, Maquina,
            `<div class="text-center">
                <div class="text-center ui buttons">
                    <button class="ui yellow button" id="EditarLinea" title="Editar Linea">
                        <i class="fa fa-edit"></i>
                    </button>
                    <div class="or"></div>
                    <button class="ui google plus button" id="EliminarLinea" title="Eliminar Linea">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>`
        ]);

        OcultaCeldas();
        LimpiarCampos();
    } else {
        msgError('Por favor', 'Complete todos los campos')
    }
});

$(document).on('click', '#EditarLinea', function (e) {
    e.preventDefault();

    filaEditar = $(this).closest("tr").get(0);
    data = Tbl_SolicitudRepuesto.fnGetData(filaEditar._DT_RowIndex);

    $("#Fecha").val(data[0]);
    $("#idCodRepuesto").val(data[1]);
    $("#codRepuesto").val(data[2]);
    $("#Descripcion").val(data[3]);
    $("#Cantidad").val(data[4]);
    $("#idMaquina").val(data[5]);
    $("#Maquina").val(data[6]);

    $('#BtnAgregarLinea').addClass('d-none');
    $('#BtnActualizarLinea').removeClass('d-none');
});

$(document).on('click', '#EliminarLinea', function (e) {
    e.preventDefault();

    var row = $(this).closest("tr").get(0);
    Tbl_SolicitudRepuesto.fnDeleteRow(Tbl_SolicitudRepuesto.fnGetPosition(row));
});

$(document).on('click', '#BtnActualizarLinea', function (e) {
    e.preventDefault();

    nFila = filaEditar._DT_RowIndex;
    Tbl_SolicitudRepuesto.fnUpdate($("#Fecha").val(), nFila, 0, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#idCodRepuesto").val(), nFila, 1, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#codRepuesto").val(), nFila, 2, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#Descripcion").val(), nFila, 3, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#Cantidad").val(), nFila, 4, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#idMaquina").val(), nFila, 5, 0, false);
    Tbl_SolicitudRepuesto.fnUpdate($("#Maquina").val(), nFila, 6, 0, false);

    $('#BtnAgregarLinea').removeClass('d-none');
    $('#BtnActualizarLinea').addClass('d-none');
    LimpiarCampos()
});

$(document).on('click', '#btnCancelarSolicitudRepuesto', function (e) {
    e.preventDefault();
    LimpiarCampos();
    Tbl_SolicitudRepuesto.fnClearTable();
});

$(document).on('click', '#btnGuardarSolicitudRepuesto', function (e) {
    e.preventDefault();
    if (Tbl_SolicitudRepuesto.fnGetData().length > 0) {
        var datos = new Array();
        iniciarArray(datos);

        $('#Tbl_SolicitudRepuesto tbody tr').each(function () {
            var Fecha = $(this).find('td').eq(0).text();
            var idCodRepuesto = $(this).find('td').eq(1).text();
            var Cantidad = $(this).find('td').eq(4).text();
            var idMaquina = $(this).find('td').eq(5).text();

            fila = { 'Fecha': Fecha, 'idCodRepuesto': idCodRepuesto, 'Cantidad': Cantidad, 'idMaquina': idMaquina };
            datos.push(fila);
        });

        if (datos.length > 0) {
            $.post('back/repuesto_solicitud.php', { datos }, function (respuesta) {
                if (respuesta != 'NoConex') {
                    if (respuesta) {
                        LimpiarCampos();
                        Tbl_SolicitudRepuesto.fnClearTable();
                        mensaje('top', 1600, 'success', 'Datos Guardados')
                    } else {
                        mensaje('top', 1500, 'error', 'Datos no guardados')
                    }
                } else {
                    msgErrorConexion()
                }
            });
        } else {
            $('#codRepuesto').focus();
            mensaje('top', 1600, 'error', 'No hay datos para guardar')
        }
    } else {
        mensaje('top', 1600, 'info', 'No hay datos para guardar')
    }
});

$('#btnModalRegistroRepuesto').click(function (e) {
    e.preventDefault();
    $('#ModalRepuestos').modal('hide');
});

$(document).on('click', '#btnRegistroRepuesto', function (e) {
    e.preventDefault();
    var datos = new Array();
    var codRepuesto = $("#modalcodRepuesto").val();
    var Descripcion = $("#modalDescripcion").val();
    var Medida = $("#modalselectMedida").val();
    const op = 'registroRepuesto';

    var fila = { 'op': op, 'codRepuesto': codRepuesto, 'Descripcion': Descripcion, 'Medida': Medida };
    datos.push(fila);

    if (!validaArrayAsociativo(datos)) {
        $.post('back/repuesto_ingreso.php', { datos }, function (respuesta) {
            if (respuesta != 'NoConex') {
                if (respuesta) {
                    LimpiarCampos();
                    mensaje('top', 1600, 'success', 'Datos Guardados')

                    $('#ModalRegistroRepuesto').modal('hide');
                    $('#tblModalRepuestos').load('tables/Tbl_ModalRepuestos.php');
                    $('#ModalRepuestos').modal('show');
                } else {
                    mensaje('top', 1500, 'error', 'Datos no guardados')
                }
            } else {
                msgErrorConexion()
            }
        });
    } else {
        $('#modalcodRepuesto').focus();
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Por favor',
            text: 'Complete todos los campos',
            showConfirmButton: true,
        });
    }
});

function OcultaCeldas() {
    $("#Tbl_SolicitudRepuesto tr").each(function () {
        var crow = $(this);
        crow.find("td:eq(1)").css("display", "none");
        crow.find("td:eq(5)").css("display", "none");
    });
}

function LimpiarCampos() {
    $("#idCodRepuesto").val('');
    $("#codRepuesto").val('');
    $("#Descripcion").val('');
    $("#Cantidad").val('');
    $("#idMaquina").val('');
    $("#Maquina").val('');

    $("#modalcodRepuesto").val('');
    $("#modalDescripcion").val('');
    $("#modalselectMedida").val('0')
}