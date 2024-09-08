<script>
     var Tbl_VerSolicitudesRepuestos = $('#Tbl_VerSolicitudesRepuestos').dataTable({
          retrieve: true,
          order: [
               [2, "desc"]
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
</script>
<div class="card shadow-lg mt-2">
     <div class="card-body">
          <div class="table-responsive">
               <table id="Tbl_VerSolicitudesRepuestos" class="table table-hover table-sm">
                    <thead class=''>
                         <tr>
                              <th># SOLICITUD</th>
                              <th>FECHA SOLICITUD</th>
                              <th>ESTADO</th>
                              <th>ACCIONES</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         require_once('../includes/conexion.php');
                         $query = "SELECT * FROM repuesto_solicitud;";
                         $datos = mysqli_query($conex, $query);
                         while ($linea = mysqli_fetch_assoc($datos)) {
                         ?>

                              <tr>
                                   <td> <?php echo $linea['id'] ?> </td>
                                   <td> <?php echo $linea['fecha'] ?> </td>
                                   <td> <?php echo $linea['estado'] ? '<span class="badge badge-success">Compra completa</>' : '<span class="badge badge-info">Lineas Pendientes</>' ?> </td>
                                   <td>
                                        <button id="verSolicitud" class="ui icon button inverted yellow verSol">
                                             <i class="fas fa-eye"></i>
                                        </button>
                                   </td>
                              </tr>
                         <?php } ?>
               </table>
          </div>
     </div>
</div>