$(document).on('click', '#verSolicitud', function (e) {
    e.preventDefault();

    const fila = $(this).closest("tr").get(0);
    const data = Tbl_VerSolicitudesRepuestos.fnGetData(fila._DT_RowIndex);
    const idSolicitud = data[0];
    const datos = { 'op': 'verSolicitudes', 'idSolicitud': idSolicitud }

    $.post('back/repuesto_verSolicitudes.php', { datos }, function (res) {
        if (res != 'NoConex') {
            $("#BodyModal").html(res);
            $("#myModalLabel").html(`Número de Solicitud: ${idSolicitud}`);
            $('#Modal').modal('show');
        } else {
            msgErrorConexion()
        }
    });
});