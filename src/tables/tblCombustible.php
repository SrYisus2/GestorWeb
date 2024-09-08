<script>
     $('#Tbl_RegistroCombustible').dataTable({
          retrieve: true,
          order: [
               [0, "desc"]
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
               <table id="Tbl_RegistroCombustible" class="table table-hover table-sm">
                    <thead>
                         <tr>
                              <th>FECHA</th>
                              <th># BOLETA</th>
                              <th>CANTIDAD LTS</th>
                              <th>SALDO LTS</th>
                              <th>DESPACHADOR</th>
                              <th>ESTADO</th>
                              <th>ACCIONES</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         require_once('../includes/conexion.php');
                         $query = "SELECT c.id, c.fecha, c.boleta, c.cantidadlts, i.saldolts, d.nombre, c.estado FROM combustible c INNER JOIN combustible_inventario i ON i.idCombustible = c.id INNER JOIN despachador d ON d.id = c.idDespachador";
                         $datos = mysqli_query($conex, $query);

                         while ($linea = mysqli_fetch_assoc($datos)) {
                         ?>

                              <tr>
                                   <td> <?php echo $linea['fecha'] ?> </td>
                                   <td> <?php echo $linea['boleta'] ?> </td>
                                   <td> <?php echo $linea['cantidadlts'] ?> </td>
                                   <td> <?php echo $linea['saldolts'] ?> </td>
                                   <td> <?php echo $linea['nombre'] ?> </td>
                                   <td> <?php echo $linea['estado'] ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' ?> </td>
                                   <td>
                                        <div class='p-0 m-0 text-center'>
                                             <button onclick="eliminarCombustible('<?= $linea['id'] ?>')" class="ui icon button inverted red">
                                                  <i class="fas fa-trash"></i>
                                             </button>
                                        </div>
                                   </td>
                              </tr>
                         <?php } ?>
               </table>
          </div>
     </div>
</div>