<div class="card shadow-lg mt-2">
    <div class="card-body">
        <div class="table-responsiv-lg">
            <table id="tblVerSolicitudes" class="table table-hover table-sm w-100">
                <thead>
                    <tr>
                        <th><label># Máquina</label></th>
                        <th><label>Código Repuesto</label></th>
                        <th><label>Descripcion</label></th>
                        <th><label>Cantidad</label></th>
                        <th><label>Estado</label></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('../includes/conexion.php');

                    $datos = $_REQUEST['datos'];
                    $op = $datos['op'];
                    $repuesta = false;

                    $query = "SELECT m.Codigo AS CodMaquina, r.Codigo AS codRepuesto, r.Descripcion AS descriRepuesto, rsd.cantidad, rsd.estado 
                    FROM repuesto_solicitud rs 
                    INNER JOIN repuesto_solicituddetalle rsd ON rsd.idSolicitud = rs.id 
                    INNER JOIN repuesto r ON r.id = rsd.idRepuesto 
                    INNER JOIN maquinaria m ON m.id = rsd.idMaquina
                    WHERE rsd.idSolicitud = " . $datos['idSolicitud'];

                    $datos = mysqli_query($conex, $query);

                    while ($linea = mysqli_fetch_assoc($datos)) {
                    ?>
                        <tr>
                            <td> <?php echo $linea['CodMaquina'] ?> </td>
                            <td> <?php echo $linea['codRepuesto'] ?> </td>
                            <td> <?php echo $linea['descriRepuesto'] ?> </td>
                            <td> <?php echo $linea['cantidad'] ?> </td>
                            <td> <?php echo $linea['estado'] ? '<span class="badge badge-success">Comprado</>' : '<span class="badge badge-info">Pendiente</>' ?> </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>