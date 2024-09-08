Tbl_SalidaRepuesto = $('#Tbl_SalidaRepuesto').dataTable({
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

$('#BtnModalRepuesto').click(function (e) {
     e.preventDefault();
     $('#tblModalRepuestos').load('tables/Tbl_ModalRepuestos.php');
});

$('#BtnModalMaquinaria').click(function (e) {
     e.preventDefault();
     $('#tblModalMaquinaria').load('tables/Tbl_ModalMaquinaria.php');
});

$('#BtnModalResponsable').click(function (e) {
     e.preventDefault();
     $('#ModalRespo').load('tables/Tbl_ModalDespachadores.php');
});

$(document).on('click', '#BtnAgregarRepuesto', function (e) {
     e.preventDefault();
     r = $(this).parent().parent()[0];
     FilaModalRepuestos = tbl_ModalRepuestos.fnGetData(r);

     $("#idCodRepuesto").val(FilaModalRepuestos[1]);
     $("#codRepuesto").val(FilaModalRepuestos[2]);
     $("#Cantidad").focus();
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
     fila = $(this).parent().parent()[0];
     datos = Tbl_ModalDespachador.fnGetData(fila);

     $("#idResponsable").val(datos[1]);
     $("#Responsable").val(datos[3]);
});

$(document).on('click', '#BtnAgregarLinea', function (e) {
     e.preventDefault();
     var datos = new Array();
     var Fecha = $("#Fecha").val();
     var idCodRepuesto = $("#idCodRepuesto").val();
     var codRepuesto = $("#codRepuesto").val();
     var Cantidad = $("#Cantidad").val();
     var idMaquina = $("#idMaquina").val();
     var Maquina = $("#Maquina").val();
     var idResponsable = $("#idResponsable").val();
     var Responsable = $("#Responsable").val();

     iniciarArray(datos);
     datos.push(Fecha, idCodRepuesto, codRepuesto, Cantidad, idMaquina, Maquina, idResponsable, Responsable);

     if (!validaInputs(datos)) {
          Tbl_SalidaRepuesto.fnAddData([
               Fecha, idCodRepuesto, codRepuesto, Cantidad, idMaquina, Maquina, idResponsable, Responsable,
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
          $('#codRepuesto').focus();
          Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Por favor',
               text: 'Complete todos los campos',
               showConfirmButton: true,
          });
     }
});

$(document).on('click', '#EditarLinea', function (e) {
     e.preventDefault();
     filaEditar = $(this).closest("tr").get(0);
     data = Tbl_SalidaRepuesto.fnGetData(filaEditar._DT_RowIndex);
     $("#Fecha").val(data[0]);
     $("#idCodRepuesto").val(data[1]);
     $("#codRepuesto").val(data[2]);
     $("#Cantidad").val(data[3]);
     $("#idMaquina").val(data[4]);
     $("#Maquina").val(data[5]);
     $("#idResponsable").val(data[6]);
     $("#Responsable").val(data[7]);

     $('#BtnAgregarLinea').addClass('d-none');
     $('#BtnActualizarLinea').removeClass('d-none');
});

$(document).on('click', '#BtnActualizarLinea', function (e) {
     e.preventDefault();
     nFila = filaEditar._DT_RowIndex;
     Tbl_SalidaRepuesto.fnUpdate($("#Fecha").val(), nFila, 0, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#idCodRepuesto").val(), nFila, 1, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#codRepuesto").val(), nFila, 2, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#Cantidad").val(), nFila, 3, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#idMaquina").val(), nFila, 4, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#Maquina").val(), nFila, 5, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#idResponsable").val(), nFila, 6, 0, false);
     Tbl_SalidaRepuesto.fnUpdate($("#Responsable").val(), nFila, 7, 0, false);

     LimpiarCampos();
     $('#BtnActualizarLinea').addClass('d-none');
     $('#BtnAgregarLinea').removeClass('d-none');
});

$(document).on('click', '#EliminarLinea', function (e) {
     e.preventDefault();
     var row = $(this).closest("tr").get(0);
     Tbl_SalidaRepuesto.fnDeleteRow(Tbl_SalidaRepuesto.fnGetPosition(row));

});

$(document).on('click', '#btnCancelarSalidaRepuesto', function (e) {
     e.preventDefault();
     LimpiarCampos();
     Tbl_SalidaRepuesto.fnClearTable();
});

$(document).on('click', '#btnGuardarSalidaRepuesto', function (e) {
     e.preventDefault();
     if (Tbl_SalidaRepuesto.fnGetData().length > 0) {
          var datos = new Array();

          $('#Tbl_SalidaRepuesto tbody tr').each(function () {
               var Fecha = $(this).find('td').eq(0).text();
               var idCodRepuesto = $(this).find('td').eq(1).text();
               var Cantidad = $(this).find('td').eq(3).text();
               var idMaquina = $(this).find('td').eq(4).text();
               var idResponsable = $(this).find('td').eq(6).text();

               var fila = new Array(Fecha, idCodRepuesto, Cantidad, idMaquina, idResponsable);
               datos.push(fila);
          });

          if (!validaInputs(datos[0])) {
               $.post('back/repuesto_salida.php', { datos }, function (respuesta) {
                    if (respuesta != 'NoConex') {
                         if (respuesta) {
                              LimpiarCampos();
                              Tbl_SalidaRepuesto.fnClearTable();
                              mensaje('top', 1600, 'success', 'Datos Guardados');
                         } else {
                              mensaje('top', 1600, 'error', 'Datos no guardados');
                         }
                    } else {
                         msgErrorConexion()
                    }
               });
          } else {
               $('#codRepuesto').focus();
               mensaje('top', 1600, 'error', 'Falta algún dato en la tabla');
          }
     } else {
          mensaje('top', 1600, 'info', 'No hay datos para guardar')
     }
});

function LimpiarCampos() {
     $("#idCodRepuesto").val('0');
     $("#codRepuesto").val('');
     $("#Descripcion").val('');
     $("#Cantidad").val('');
     $("#selectMedida").val('0');
     $("#idMaquina").val('0');
     $("#Maquina").val('');
     $("#idResponsable").val('0');
     $("#Responsable").val('');
}

function OcultaCeldas() {
     $("#Tbl_SalidaRepuesto tr").each(function () {
          var crow = $(this);
          crow.find("td:eq(1)").css("display", "none");
          crow.find("td:eq(4)").css("display", "none");
          crow.find("td:eq(6)").css("display", "none");
     });
}