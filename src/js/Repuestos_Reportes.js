setTableOrder('Tbl_Reporte_Compra');
setTableOrder('Tbl_Reporte_Salidas');
setTable('Tbl_Reporte_Inventario');

function setTable(table) {
     $(`#${table}`).dataTable({
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
};

function setTableOrder(table) {
     $(`#${table}`).dataTable({
          retrieve: true,
          order: [
               [1, "desc"]
          ],
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
};

$('#chkIngresos').click(function (e) {
     if ($('#chkIngresos').is(':checked')) {
          $('#chkSalidas').attr('disabled', 'true');
     } else {
          $('#chkSalidas').removeAttr('disabled');
     }
});

$('#chkSalidas').click(function (e) {
     if ($('#chkSalidas').is(':checked')) {
          $('#chkIngresos').attr('disabled', 'true');
     } else {
          $('#chkIngresos').removeAttr('disabled');
     }
});

$('#BtnBuscarReporte').click(function (e) {
     e.preventDefault();
     const chkIngresos = $('#chkIngresos').is(':checked');
     const chkSalidas = $('#chkSalidas').is(':checked');
     const FechaInicio = $('#FechaInicio').val();
     const FechaFin = $('#FechaFin').val();
     const datos = new Array();

     if (FechaInicio != '' && FechaFin != '') {
          if (chkIngresos) {
               const op = 'Ingresos'
               datos.push(op, FechaInicio, FechaFin);

               $.post('back/repuesto_reportes.php', { datos }, function (res) {
                    if (res != 'NoConex') {
                         const respuesta = JSON.parse(res);

                         if (respuesta != 0) {
                              $(".divReporte").append($('<div id="Reporte"></div>'));
                              $("#Reporte").html(respuesta.table);
                              setTable('tblIngresos');
                              $('#BtnCancelar').removeClass('d-none');
                         } else {
                              mensaje('top', 1600, 'info', 'No hay datos para ese rango de fechas')
                         }
                    } else {
                         msgErrorConexion()
                    }
               });
          } else if (chkSalidas) {
               const op = 'Salidas'
               datos.push(op, FechaInicio, FechaFin);

               $.post('back/repuesto_reportes.php', { datos }, function (res) {
                    if (res != 'NoConex') {
                         const respuesta = JSON.parse(res);

                         if (respuesta != 0) {
                              $(".divReporte").append($('<div id="Reporte"></div>'));
                              $("#Reporte").html(respuesta.table);
                              setTable('tblSalidas');
                              $('#BtnCancelar').removeClass('d-none');
                         } else {
                              mensaje('top', 1600, 'info', 'No hay datos para ese rango de fechas')
                         }
                    } else {
                         msgErrorConexion()
                    }
               });
          } else {
               mensaje('top', 1600, 'info', 'Debes seleccionar el tipo de reporte')
          }
     } else {
          mensaje('top', 1600, 'info', 'Elige las fechas correspondientes')
     }
});

$('#BtnCancelar').click(function (e) {
     $('#chkSalidas').removeAttr('disabled');
     $('#chkIngresos').removeAttr('disabled');

     $("#chkIngresos").prop('checked', false);
     $("#chkSalidas").prop('checked', false);

     $('#FechaInicio').val('');
     $('#FechaFin').val('');

     $("#Reporte").remove();
     $('#BtnCancelar').addClass('d-none');
});