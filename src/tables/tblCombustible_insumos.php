<script>
    $('#Tbl_CombustibleInsumos').dataTable({
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
</script>
<div class="card shadow-lg mt-2">
    <div class="card-body">
        <div class="table-responsive">
            <table id="Tbl_CombustibleInsumos" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th><label>FECHA</label></th>
                        <th><label>BOLETA DESPACHO</label></th>
                        <th><label>MAQUINA</label></th>
                        <th><label>CANTIDAD LTS</label></th>
                        <th><label>BOLETA COMBUSTIBLE</label></th>
                        <th><label>RESPONSABLE</label></th>
                        <th><label>ACCIONES</label></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../includes/conexion.php');
                    $query = "SELECT ci.id, ci.fecha, ci.BoletaDesp, m.Codigo, ci.cantidadlts, c.id AS idCombustible, c.boleta, d.nombre FROM combustible_insumo ci INNER JOIN maquinaria m ON m.id = ci.idMaquina INNER JOIN combustible c ON c.id = ci.idBoletaComb INNER JOIN despachador d ON d.id = ci.idDespachador";
                    $datos = mysqli_query($conex, $query);

                    while ($linea = mysqli_fetch_assoc($datos)) {
                    ?>

                        <tr>
                            <td> <?php echo $linea['fecha'] ?> </td>
                            <td> <?php echo $linea['BoletaDesp'] ?> </td>
                            <td> <?php echo $linea['Codigo'] ?> </td>
                            <td> <?php echo $linea['cantidadlts'] ?> </td>
                            <td> <?php echo $linea['boleta'] ?> </td>
                            <td> <?php echo $linea['nombre'] ?> </td>
                            <td>
                                <div class='p-0 m-0 text-center'>
                                    <button onclick="eliminarInsumo(<?php echo $linea['id'] . ',' . $linea['idCombustible'] . ',' . $linea['cantidadlts'] ?>)" class="ui icon button inverted red">
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