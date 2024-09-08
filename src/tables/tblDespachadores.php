<script>
    $('#Tbl_Despachadores').dataTable({
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
<div class="card shadow-lg mt-2">
    <div class="card-body">
        <div class="table-responsive">
            <table id="Tbl_Despachadores" class="table table-hover table-sm">
                <thead class=''>
                    <tr>
                        <th>IDENTIFICACION</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../includes/conexion.php');
                    $query = "SELECT id, identificacion, nombre, telefono, estado FROM despachador";
                    $datos = mysqli_query($conex, $query);

                    while ($linea = mysqli_fetch_assoc($datos)) {
                    ?>

                        <tr>
                            <td> <?php echo $linea['identificacion'] ?> </td>
                            <td> <?php echo $linea['nombre'] ?> </td>
                            <td> <?php echo $linea['telefono'] ?> </td>
                            <td> <?php echo $linea['estado'] ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' ?> </td>
                            <td>
                                <?php if ($linea['estado']) { ?>
                                    <div class='p-0 m-0 text-center'>
                                        <button onclick="editarDespachador('<?= $linea['id'] ?>')" class="ui icon button inverted yellow">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="eliminarDespachador('<?= $linea['id'] ?>')" class="ui icon button inverted red">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                <?php } else { ?>
                                    <div class='p-0 m-0 text-center'>
                                        <button disabled onclick="editarDespachador('<?= $linea['id'] ?>')" class="ui icon button inverted yellow">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="habilitarDespachador('<?= $linea['id'] ?>')" class="ui icon button inverted green">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>