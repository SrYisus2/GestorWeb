(() => {
    document.addEventListener("DOMContentLoaded", async () => {
        try {
            ingresoMensualCombustible();
            consumoMensualCombustible();
            MaquinariaDisponible();
            SoliRepuestoPendiente();
        } catch (e) {
            console.log("Error al ejecutar funciones: " + e);
        }
    });
})();

function ingresoMensualCombustible() {
    var datos = new Array();
    var op = 'ingresoMensualCombustible';

    datos.push(op);

    $.post('back/Dashboard.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            $("#ingresoMensualCombustible").html(`${respuesta} Lts`);
        } else {
            msgErrorConexion()
        }
    });
}

function consumoMensualCombustible() {
    var datos = new Array();
    var op = 'consumoMensualCombustible';

    datos.push(op);

    $.post('back/Dashboard.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            $("#consumoMensualCombustible").html(`${respuesta} Lts`);
        } else {
            msgErrorConexion()
        }
    });
}

function MaquinariaDisponible() {
    var datos = new Array();
    var op = 'MaquinariaDisponible';

    datos.push(op);

    $.post('back/Dashboard.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            $("#MaquinariaDisponible").html(`${respuesta}%`);
            $("#barMaquinariaDisponible").css('width', `${respuesta}%`);
        } else {
            msgErrorConexion()
        }
    });
}

function SoliRepuestoPendiente() {
    var datos = new Array();
    var op = 'SoliRepuestoPendiente';

    datos.push(op);

    $.post('back/Dashboard.php', { datos }, function (respuesta) {
        if (respuesta != 'NoConex') {
            $("#SoliRepuestoPendiente").html(respuesta);
        } else {
            msgErrorConexion()
        }
    });
}

$('#BtnModalRevisarMaquina').click(function (e) {
    e.preventDefault();
    if ($('#codMaquina').val() != "") {
        var datos = new Array();
        let op = 'RevisarMaquina';
        let codMaquina = $('#codMaquina').val();
        datos.push(op, codMaquina);

        $.post('back/Dashboard.php', { datos }, function (res) {
            if (res != 'NoConex') {
                let respuesta = JSON.parse(res);
                if (respuesta != null) {
                    let estado = respuesta.Estado == 1 ? 'Activo' : 'Inactivo';
                    let modalBody = `<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Codigo" class="control-label">Código</label>
                                                <input value="${respuesta.Codigo}" class="form-control" id="Codigo" name="Codigo" disabled type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="Descripcion" class="control-label">Descripción</label>
                                                <input value="${respuesta.Descripcion}" class="form-control" id="Descripcion" name="Descripcion" disabled type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="Marca" class="control-label">Marca</label>
                                                <input value="${respuesta.Marca}" class="form-control" id="Marca" name="Marca" disabled type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="Modelo" class="control-label">Modelo</label>
                                                <input value="${respuesta.Modelo}" class="form-control" id="Modelo" name="Modelo" disabled type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="estado" class="control-label">Estado</label>
                                                <input value="${estado}" class="form-control" id="estado" name="estado" disabled type="text">
                                            </div>
                                        </div>
                                </div>`;
                    $("#BodyModal").html(modalBody);
                    $("#myModalLabel").html(`Esto de la Máquina ${respuesta.Codigo}`);
                    $('#Modal').modal('show');
                } else {
                    $('#codMaquina').focus()
                    mensaje('top', 1600, 'info', 'Codigo de máquina no existe')
                }
            } else {
                msgErrorConexion()
            }
        });
    } else {
        $('#codMaquina').focus()
        mensaje('top', 1600, 'error', 'Ingresa el codigo de la maquina')
    }
});

$('#btnRevisarSolicitud').click(function (e) {
    e.preventDefault();
    if ($('#seguimientoSolicitud').val() != "") {
        var datos = new Array();
        let op = 'seguimientoSolicitud';
        let nSolicitud = $('#seguimientoSolicitud').val();
        datos.push(op, nSolicitud);

        $.post('back/Dashboard.php', { datos }, function (res) {
            if (res != 'NoConex') {
                const respuesta = JSON.parse(res);

                if (respuesta.fecha != undefined) {
                    const fecha = new Date(respuesta.fecha).toLocaleDateString('en-US');

                    $("#BodyModal").html(respuesta.table);
                    $("#myModalLabel").html(`Fecha de la Solicitud: ${fecha}`);
                    $('#Modal').modal('show');
                } else {
                    $('#seguimientoSolicitud').focus()
                    mensaje('top', 1500, 'info', 'Número de solicitud no existe')
                }
            } else {
                msgErrorConexion()
            }
        });
    } else {
        $('#seguimientoSolicitud').focus()
        mensaje('top', 1500, 'error', 'Ingresa el Número de solicitud')
    }
});

$('#btnRevisarExistenciaRepuesto').click(function (e) {
    e.preventDefault();
    if ($('#existenciaRepuesto').val() != "") {
        var datos = new Array();
        let op = 'existenciaRepuesto';
        let existenciaRepuesto = $('#existenciaRepuesto').val();
        datos.push(op, existenciaRepuesto);

        $.post('back/Dashboard.php', { datos }, function (res) {
            if (res != 'NoConex') {
                const respuesta = JSON.parse(res);

                if (respuesta) {
                    $("#BodyModal").html(respuesta.table);
                    $("#myModalLabel").html(`Stock de repuestos`);
                    $('#Modal').modal('show');
                } else {
                    $('#existenciaRepuesto').focus()
                    mensaje('top', 1500, 'info', 'Número de solicitud no existe')
                }
            } else {
                msgErrorConexion()
            }
        });
    } else {
        $('#existenciaRepuesto').focus()
        mensaje('top', 1500, 'error', 'Ingrese nombre o código del repuestso')
    }
});

$('#Modal').on('hide.bs.modal', function (e) {
    $('#codMaquina').val('');
    $('#seguimientoSolicitud').val('');
    $('#existenciaRepuesto').val('');
    $("#BodyModal").html('');
    $("#myModalLabel").html('');
});