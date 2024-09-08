$('#BtnGuardarMaquina').on('click', function (e) {
     e.preventDefault();
     var datos = new Array();
     var codigo = $('#txtCodigo').val();
     var descripcion = $('#txtDescripcion').val();
     var marca = $('#txtMarca').val();
     var modelo = $('#txtModelo').val();
     var op = 'insertar';

     datos.push(op, codigo, descripcion, marca, modelo);

     if (!validaInputs(datos)) {
          $.post('back/Maquinaria.php', { datos }, function (respuesta) {
               if (respuesta != 'NoConex') {
                    if (respuesta) {
                         LimpiarCampos();
                         mensaje('top', 1600, 'success', 'Datos Guardados')
                         $('#Tbl_MaqRegistro').load('tables/tblMaquinaria.php');
                    } else {
                         mensaje('top', 1500, 'error', 'Datos no guardados')
                    }
               } else {
                    msgErrorConexion()
               }
          });
     }
     else {
          $('#txtCodigo').focus();
          Swal.fire({
               position: 'center',
               type: 'error',
               title: 'Por favor',
               text: 'Complete todos los campos',
               showConfirmButton: true,
          });

     }
});

$('#BtnActualizarMaquina').on('click', function (e) {
     e.preventDefault();
     var datos = new Array();
     var codigo = $('#txtCodigo').val();
     var descripcion = $('#txtDescripcion').val();
     var marca = $('#txtMarca').val();
     var modelo = $('#txtModelo').val();
     var op = 'actualizar';

     datos.push(op, codigo, descripcion, marca, modelo);

     if (!validaInputs(datos)) {
          $.post('back/Maquinaria.php', { datos }, function (respuesta) {
               if (respuesta != 'NoConex') {
                    if (respuesta == true) {
                         mensaje('top', 1500, 'success', 'Datos actualizados')

                         LimpiarCampos();
                         $('#CardRegistroMaquina').removeClass('show');
                         $('#BtnGuardarMaquina').removeClass('d-none');
                         $('#BtnActualizarMaquina').addClass('d-none');
                         $('#Tbl_MaqRegistro').load('tables/tblMaquinaria.php');
                    } else {
                         mensaje('top', 1500, 'error', 'Datos No Guardados')
                    }
               } else {
                    msgErrorConexion()
               }
          });
     }
     else {
          $('#txtCodigo').focus();
          mensaje('top', 1500, 'error', 'Complete todos los campos')

     }
});

function editarMaquinaria(id) {
     var datos = new Array();
     var op = 'buscar';
     datos.push(op, id);

     $.post('back/Maquinaria.php', { datos }, function (respuesta) {
          if (respuesta != 'NoConex') {
               maq = JSON.parse(respuesta);
               $('#txtCodigo').val(maq.Codigo);
               $('#txtDescripcion').val(maq.Descripcion);
               $('#txtMarca').val(maq.Marca);
               $('#txtModelo').val(maq.Modelo);

               $('#BtnGuardarMaquina').addClass('d-none');
               $('#BtnActualizarMaquina').removeClass('d-none');
               $('#CardRegistroMaquina').addClass('show');

          } else {
               msgErrorConexion()
          }
     });
}

function eliminarMaquinaria(id) {
     var datos = new Array();
     var op = 'eliminar';
     datos.push(op, id);

     $.post('back/Maquinaria.php', { datos }, function (respuesta) {
          if (respuesta != 'NoConex') {
               if (respuesta) {
                    mensaje('top', 1500, 'success', 'Maquina eliminada')
                    $('#Tbl_MaqRegistro').load('tables/tblMaquinaria.php');
               }
          } else {
               msgErrorConexion()
          }
     });
}

function habilitarMaquinaria(id) {
     var datos = new Array();
     var op = 'habilitar';
     datos.push(op, id);

     $.post('back/Maquinaria.php', { datos }, function (respuesta) {
          if (respuesta != 'NoConex') {
               if (respuesta) {
                    mensaje('top', 1500, 'success', 'Maquina habilitada')
                    $('#Tbl_MaqRegistro').load('tables/tblMaquinaria.php');
               }
          } else {
               msgErrorConexion()
          }
     });
}

function LimpiarCampos() {
     $('#txtCodigo').val('');
     $('#txtDescripcion').val('');
     $('#txtMarca').val('');
     $('#txtModelo').val('');
}