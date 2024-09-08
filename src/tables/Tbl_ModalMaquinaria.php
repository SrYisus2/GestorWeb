<script>
     Tbl_ModalMaquinaria = $('#Tbl_ModalMaquinaria').dataTable({
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
</script>

<div class="table-responsive">
     <table id="Tbl_ModalMaquinaria" class="table table-hover table-sm w-100">
          <thead>
               <tr>
                    <th></th>
                    <th class="d-none"></th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
               </tr>
          </thead>
          <?php include_once('../includes/conexion.php'); ?>
          <?php
          if (!$conex) {
               echo 'NoConex';
          } else {
               $btn2 = '<button disabled id="BtnAgregarMaquina" data-dismiss="modal" title="Agregar" class="btn btn-primary btn-agregar"> <i class="fa fa-plus-circle"></i> </button>&nbsp';

               $query = "SELECT Id, Codigo, Descripcion, Marca, Modelo, Estado FROM maquinaria";
               $result = mysqli_query($conex, $query);


               if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                         $btn1 = '<button id="BtnAgregarMaquina" data-dismiss="modal" title="Agregar" class="btn btn-warning btn-agregar"> <i class="fa fa-plus-circle"></i> </button>&nbsp';
          ?>
                         <tr>
                              <td><?php echo $btn1; ?></td>
                              <td class="d-none"><?php echo $row['Id']; ?></td>
                              <td><?php echo $row['Codigo']; ?></td>
                              <td><?php echo $row['Descripcion']; ?></td>
                              <td><?php echo $row['Marca']; ?></td>
                              <td><?php echo $row['Modelo']; ?></td>
                              <td><?php echo $status = ($row['Estado']) ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' ?> </td>
                         </tr>
          <?php
                    }
               }
          } ?>
     </table>
</div>