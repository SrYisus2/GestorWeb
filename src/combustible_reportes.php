<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reportes de Combustible</title>
    <?php
    include_once('includes/conexion.php');
    if (!$conex) {
        echo 'NoConex';
    }
    include_once("includes/head.php");
    ?>
</head>
<?php include_once("includes/bodyHead.php"); ?>

<!-- PONER PAGINAS AQUI -->
<div class="container-fluid">
    <!-- BOTONES DE EXPORTAR  -->
    <div class="card shadow mb-1">
        <a href="#CardExportar" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardExportar">
            <h6 class="m-0 font-weight-bold text-gray-800">Exportar a Excel</h6>
        </a>
        <div class="collapse" id="CardExportar">
            <div class="m-2">
                <a href="back/Exportar.php/?exportar=IngresoCombustible" class="btn btn-outline-info">Exportar Ingresos</a>
                <a href="back/Exportar.php/?exportar=SalidaCombustibles" class="btn btn-outline-dark ">Exportar Consumos</a>
                <a href="back/Exportar.php/?exportar=InventarioCombustibles" class="btn btn-outline-success ">Exportar Inventario</a>
            </div>
        </div>
    </div>

    <!-- INGRESO COMBUSTIBLE -->
    <div class="card shadow mb-1">
        <a href="#CardReporteIngresoCombustible" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardReporteIngresoCombustible">
            <h6 class="m-0 font-weight-bold text-gray-800">Reporte Ingreso de Combustible</h6>
        </a>
        <div class="collapse" id="CardReporteIngresoCombustible">
            <div class="table-responsive">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="m-0 p-0">
                            <table id="Tbl_Reporte_Compra" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th><label>Id</label></th>
                                        <th><label>Fecha</label></th>
                                        <th><label>Boleta</label></th>
                                        <th><label>Cantidad</label></th>
                                        <th><label>Responsable</label></th>
                                        <th><label>Estado</label></th>
                                    </tr>
                                </thead>

                                <?php
                                $queryIngresos = "SELECT c.id, c.fecha, c.boleta, c.cantidadlts, c.estado, d.nombre FROM combustible c INNER JOIN despachador d ON d.id = c.idDespachador ORDER BY c.fecha DESC;";

                                $result = mysqli_query($conex, $queryIngresos);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['fecha']; ?></td>
                                            <td><?php echo $row['boleta']; ?></td>
                                            <td><?php echo $row['cantidadlts']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $status = ($row['estado']) ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' ?> </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SALIDAS COMBUSTIBLE -->
    <div class="card shadow mb-1">
        <a href="#CardReporteSalidaCombustible" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardReporteSalidaCombustible">
            <h6 class="m-0 font-weight-bold text-gray-800">Reporte Salida de combustible</h6>
        </a>
        <div class="collapse" id="CardReporteSalidaCombustible">
            <div class="table-responsive">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="m-0 p-0">
                            <table id="Tbl_Reporte_Salidas" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th><label>Id</label></th>
                                        <th><label>Fecha</label></th>
                                        <th><label>Boleta Despacho</label></th>
                                        <th><label>Código de Máquina</label></th>
                                        <th><label>Cantidad</label></th>
                                        <th><label>Boleta Ingreso</label></th>
                                        <th><label>Responsable</label></th>
                                    </tr>
                                </thead>

                                <body>
                                    <?php
                                    $querySalidas = "SELECT ci.id, ci.fecha, ci.BoletaDesp, ci.cantidadlts, m.Codigo, c.boleta, d.nombre FROM combustible_insumo ci INNER JOIN maquinaria m ON m.Id = ci.idMaquina INNER JOIN combustible c ON c.id = ci.idBoletaComb INNER JOIN despachador d ON d.id = ci.idDespachador ORDER BY ci.fecha DESC;";

                                    $result = mysqli_query($conex, $querySalidas);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['fecha']; ?></td>
                                                <td><?php echo $row['BoletaDesp']; ?></td>
                                                <td><?php echo $row['Codigo']; ?></td>
                                                <td><?php echo $row['cantidadlts']; ?></td>
                                                <td><?php echo $row['boleta']; ?></td>
                                                <td><?php echo $row['nombre']; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INVENTARIO ACTUALIZADO -->
    <div class="card shadow mb-1">
        <a href="#ReporteInventarioActualizado" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ReporteInventarioActualizado">
            <h6 class="m-0 font-weight-bold text-gray-800">Reporte Saldo Combustible</h6>
        </a>
        <div class="collapse" id="ReporteInventarioActualizado">
            <div class="table-responsive">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="m-0 p-0">
                            <table id="Tbl_Reporte_Inventario" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th><label>Boleta Ingreso</label></th>
                                        <th><label>Cantidad Despachada</label></th>
                                        <th><label>Saldo</label></th>
                                    </tr>
                                </thead>

                                <?php
                                $queryInventario = "SELECT c.boleta, (SELECT SUM(cin.cantidadlts) FROM combustible_insumo cin WHERE cin.idBoletaComb = ci.id) AS despacho, ci.saldolts AS saldo FROM combustible_inventario AS ci INNER JOIN combustible AS c on c.id = ci.idCombustible;";

                                $result = mysqli_query($conex, $queryInventario);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['boleta']; ?></td>
                                            <td><?php echo $row['despacho']; ?></td>
                                            <td><?php echo $row['saldo']; ?></td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INGRESOS Y SALIDAS POR RANGO FECHAS -->
    <div class="card shadow mb-1">
        <a href="#" class="d-block card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray-800">Reporte ingresos o salidas por rango de fechas</h6>
        </a>
        <div class="card-body">
            <div class='row mb-4'>
                <div class="col-md-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="chkIngresos" required>
                        <label class="custom-control-label" for="chkIngresos">Ingresos</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="chkSalidas" required>
                        <label class="custom-control-label" for="chkSalidas">Salidas</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Fecha inicio</span>
                        </div>
                        <input type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" ID="FechaInicio" name='FechaInicio' required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Fecha fin</span>
                        </div>
                        <input type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" ID="FechaFin" name='FechaFin' required>
                    </div>
                </div>

                <div class="col-md-2">
                    <button id="BtnBuscarReporte" class="ui button yellow">Buscar</button>
                    <button id="BtnCancelar" class="ui button red d-none">Cancelar</button>
                </div>
            </div>
            <div class="divReporte">
            </div>
        </div>
    </div>
</div>
<!-- FIN PONER PAGINAS AQUI -->

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>

<script src="js/Combustible_Reportes.js"></script>

</body>

</html>