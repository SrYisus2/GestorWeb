Tbl_RegistroRepuesto = $('#Tbl_RegistroRepuesto').dataTable({
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

$(document).on('click', '#BtnBuscarnSolicitud', function (e) {
     e.preventDefault();
     if ($("#nSolicitud").val() != "") {
          const datos = new Array();
          const op = 'BuscarnSolicitud';
          var idSolicitud = $("#nSolicitud").val();

          iniciarArray(datos);
          fila = { 'op': op, 'idSolicitud': idSolicitud };
          datos.push(fila);

          if (!validaInputs(datos)) {
               $.post('back/repuesto_ingreso.php', { datos }, function (respuesta) {
                    if (respuesta != 'NoConex') {
                         const data = JSON.parse(respuesta);

                         if (data.length > 0) {
                              Tbl_RegistroRepuesto.fnClearTable();
                              for (let i = 0; i < data.length; i++) {
                                   Tbl_RegistroRepuesto.fnAddData([
                                        data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5], data[i][6], (data[i][7] == 1 ? 'Comprado' : 'No comprado'), `<input id="nComprobante" type="text" class="form-control" placeholder="Comprobante">`,
                                        `<input id="chkRegistro" type="checkbox" class="custom-checkbox"> Marcar ingreso`,
                                        idSolicitud
                                   ]);
                              }
                              OcultaCeldas();
                              LimpiarCampos();
                         } else {
                              $("#nSolicitud").focus();
                              Tbl_RegistroRepuesto.fnClearTable();
                              mensaje('top', 1500, 'info', 'Número de solicitud no existe')
                         }
                    } else {
                         msgErrorConexion()
                    }
               });
          } else {
               $('#nSolicitud').focus();
               Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: 'Complete todos los campos',
                    showConfirmButton: true,
               });
          }
     } else {
          $('#nSolicitud').focus();
          Swal.fire({
               icon: 'info',
               text: 'Debe digitar el número de solicitud',
               showConfirmButton: true,
          });
     }
});

$(document).on('click', '#btnGuardarRegistroRepuesto', function (e) {
     e.preventDefault()
     if (Tbl_RegistroRepuesto.fnGetData().length > 0) {
          var datos = new Array();
          iniciarArray(datos);
          const op = 'ingresoRepuesto';

          $('#Tbl_RegistroRepuesto tbody tr').each(function () {
               const check = $(this).find('td').eq(9)[0].children[0].checked;

               if (check) {
                    const idMaquina = $(this).find('td').eq(0).text()
                    const idRepuesto = $(this).find('td').eq(2).text()
                    const codRepuesto = $(this).find('td').eq(3).text()
                    const Descripcion = $(this).find('td').eq(4).text()
                    const Cantidad = $(this).find('td').eq(5).text()
                    const Medida = $(this).find('td').eq(6).text()
                    const nComprobante = $(this).find('td').eq(8)[0].children[0].value
                    const idSolicitud = $(this).find('td').eq(10).text()

                    fila = { 'op': op, 'idSolicitud': idSolicitud, 'idRepuesto': idRepuesto, 'codRepuesto': codRepuesto, 'Descripcion': Descripcion, 'idMaquina': idMaquina, 'Cantidad': Cantidad, 'Medida': Medida, 'nComprobante': nComprobante };
                    datos.push(fila);
               }
          });

          if (datos.length > 0) {
               $.post('back/repuesto_ingreso.php', { datos }, function (respuesta) {
                    if (respuesta != 'NoConex') {
                         if (respuesta) {
                              LimpiarCampos();
                              Tbl_RegistroRepuesto.fnClearTable();
                              mensaje('top', 1600, 'success', 'Datos Guardados')
                         } else {
                              mensaje('top', 1500, 'error', 'Datos no guardados')
                         }
                    } else {
                         msgErrorConexion()
                    }
               });
          } else {
               mensaje('top', 1600, 'error', 'Debe marcar los datos a guardar');
               return false;
          }
     } else {
          $("#nSolicitud").focus()
          mensaje('top', 1600, 'info', 'No hay datos para guardar')
     }
});

$(document).on('click', '#btnCancelarRegistroRepuesto', function (e) {
     e.preventDefault();
     LimpiarCampos();
     Tbl_RegistroRepuesto.fnClearTable();
});

function LimpiarCampos() {
     $("#nSolicitud").val('');
}

function OcultaCeldas() {
     $("#Tbl_RegistroRepuesto tr").each(function () {
          var crow = $(this);
          crow.find("td:eq(0)").css("display", "none");
          crow.find("td:eq(2)").css("display", "none");
          crow.find("td:eq(10)").css("display", "none");
     });
}



$('#BtnModalRepuesto').click(function (e) {
     e.preventDefault();
     $('#tblModalRepuestos').load('tables/Tbl_ModalRepuestos.php');
});

$(document).on('click', '#BtnAgregarRepuesto', function (e) {
     e.preventDefault();
     r = $(this).parent().parent()[0];
     FilaModalRepuestos = tbl_ModalRepuestos.fnGetData(r);

     $("#idCodRepuesto").val(FilaModalRepuestos[1]);
     $("#codRepuesto").val(FilaModalRepuestos[2]);
     $("#Descripcion").val(FilaModalRepuestos[3]);
     $("#selectMedida").val(FilaModalRepuestos[5]);
     $("#Cantidad").focus();
});

$(document).on('click', '#BtnAgregarLinea', function (e) {
     e.preventDefault();
     var datos = new Array();
     var Fecha = $("#Fecha").val();
     var idCodRepuesto = $("#idCodRepuesto").val();
     var codRepuesto = $("#codRepuesto").val();
     var Descripcion = $("#Descripcion").val();
     var Cantidad = $("#Cantidad").val();
     var Comprobante = $("#Comprobante").val();
     var Medida = $("#selectMedida").val()

     iniciarArray(datos);
     datos.push(Fecha, codRepuesto, Descripcion, Cantidad, Medida, Comprobante);

     if (!validaInputs(datos)) {
          Tbl_RegistroRepuesto.fnAddData([
               Fecha, idCodRepuesto, codRepuesto, Descripcion, Cantidad, Medida, Comprobante,
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

$(document).on('click', '#EliminarLinea', function (e) {
     e.preventDefault();
     var row = $(this).closest("tr").get(0);
     Tbl_RegistroRepuesto.fnDeleteRow(Tbl_RegistroRepuesto.fnGetPosition(row));

});

$(document).on('click', '#EditarLinea', function (e) {
     e.preventDefault();
     filaEditar = $(this).closest("tr").get(0);
     data = Tbl_RegistroRepuesto.fnGetData(filaEditar._DT_RowIndex);
     $("#Fecha").val(data[0]);
     $("#idCodRepuesto").val(data[1]);
     $("#codRepuesto").val(data[2]);
     $("#Descripcion").val(data[3]);
     $("#Cantidad").val(data[4]);
     $("#selectMedida").val(data[5]);
     $("#Comprobante").val(data[6]);

     $('#BtnAgregarLinea').addClass('d-none');
     $('#BtnActualizarLinea').removeClass('d-none');
});

$(document).on('click', '#BtnActualizarLinea', function (e) {
     e.preventDefault();
     // var filaSelec = $(this).closest("tr").get(0);
     nFila = filaEditar._DT_RowIndex;
     Tbl_RegistroRepuesto.fnUpdate($("#Fecha").val(), nFila, 0, 0, false);
     Tbl_RegistroRepuesto.fnUpdate($("#idCodRepuesto").val(), nFila, 1, 0, false);
     Tbl_RegistroRepuesto.fnUpdate($("#codRepuesto").val(), nFila, 2, 0, false);
     Tbl_RegistroRepuesto.fnUpdate($("#Descripcion").val(), nFila, 3, 0, false);
     Tbl_RegistroRepuesto.fnUpdate($("#Cantidad").val(), nFila, 4, 0, false);
     Tbl_RegistroRepuesto.fnUpdate(medida, nFila, 5, 0, false);
     Tbl_RegistroRepuesto.fnUpdate($("#Comprobante").val(), nFila, 6, 0, false);

     LimpiarCampos();
     $('#BtnActualizarLinea').addClass('d-none');
     $('#BtnAgregarLinea').removeClass('d-none');
});

$(document).on('change', '#selectMedida', function (e) {
     e.preventDefault();
     Medida = $(this).val();
});

$(document).on('click', '#BtnAgregarRepuesto', function (e) {
     e.preventDefault();
     // Boton - TR    -  TD
     r = $(this).parent().parent()[0];
     // De la tabla obtiene los datos de esa fila 
     FilaModalRepuestos = tbl_ModalRepuestos.fnGetData(r);

     $("#txtCodigo").val(FilaModalRepuestos[1]);
     $("#txtDescripcion").val(FilaModalRepuestos[2]);
     $('#Tbl_ModalRepSalidas').load('Tablas/Tbl_ModalRepSalidas.php');
});