<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reportes de Repuestos</title>
  <?php
  include_once("includes/head.php"); ?>
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
        <a href="back/Exportar.php/?exportar=IngresoRepuesto" class="btn btn-outline-info">Exportar Ingresos</a>
        <a href="back/Exportar.php/?exportar=SalidaRepuestos" class="btn btn-outline-dark ">Exportar Consumos</a>
        <a href="back/Exportar.php/?exportar=InventarioRepuestos" class="btn btn-outline-success ">Exportar Inventario</a>
      </div>
    </div>
  </div>

  <!-- INGRESO REPUESTOS -->
  <div class="card shadow mb-1">
    <a href="#CardReporteIngresoRepuestos" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardReporteIngresoRepuestos">
      <h6 class="m-0 font-weight-bold text-gray-800">Reporte Ingreso de Repuestos</h6>
    </a>
    <div class="collapse" id="CardReporteIngresoRepuestos">
      <div class="table-responsive">
        <div class="card shadow">
          <div class="card-body">
            <div class="m-0 p-0">
              <table id="Tbl_Reporte_Compra" class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th><label>Id</label></th>
                    <th><label>Fecha</label></th>
                    <th><label>Código</label></th>
                    <th><label>Descripción</label></th>
                    <th><label>Cantidad</label></th>
                    <th><label>Medida</label></th>
                    <th><label>Comprobante</label></th>
                  </tr>
                </thead>

                <?php include_once('includes/conexion.php'); ?>
                <?php
                if (!$conex) {
                  echo 'NoConex';
                } else {
                  $queryIngresos = "SELECT id, Fecha, Codigo, Descripcion, Cantidad, Medida, Comprobante FROM repuesto ORDER BY Fecha DESC;";
                  $result = mysqli_query($conex, $queryIngresos);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Fecha']; ?></td>
                        <td><?php echo $row['Codigo']; ?></td>
                        <td><?php echo $row['Descripcion']; ?></td>
                        <td><?php echo $row['Cantidad']; ?></td>
                        <td><?php echo $row['Medida']; ?></td>
                        <td><?php echo $row['Comprobante']; ?></td>
                      </tr>
                <?php
                    }
                  }
                } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SALIDAS REPUESTOS -->
  <div class="card shadow mb-1">
    <a href="#CardReporteSalidaRepuestos" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardReporteSalidaRepuestos">
      <h6 class="m-0 font-weight-bold text-gray-800">Reporte Salida Repuestos</h6>
    </a>
    <div class="collapse" id="CardReporteSalidaRepuestos">
      <div class="table-responsive">
        <div class="card shadow">
          <div class="card-body">
            <div class="m-0 p-0">
              <table id="Tbl_Reporte_Salidas" class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th><label>Id</label></th>
                    <th><label>Fecha</label></th>
                    <th><label>Código de Repuesto</label></th>
                    <th><label>Descripción</label></th>
                    <th><label>Cantidad</label></th>
                    <th><label>Código de Máquina</label></th>
                    <th><label>Responsable</label></th>
                  </tr>
                </thead>

                <?php include_once('includes/conexion.php'); ?>
                <?php
                if (!$conex) {
                  echo 'NoConex';
                } else {
                  $querySalidas = "SELECT rs.id, rs.Fecha, r.Codigo AS codRepuesto, r.Descripcion, rs.Cantidad, m.Codigo AS codMaquina, desp.nombre FROM repuesto_salida rs right JOIN repuesto r ON r.id = rs.idRepuesto INNER JOIN maquinaria m ON m.Id = rs.idMaquina INNER JOIN despachador desp ON desp.id = rs.idResponsable ORDER BY rs.Fecha DESC;";

                  $result = mysqli_query($conex, $querySalidas);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Fecha']; ?></td>
                        <td><?php echo $row['codRepuesto']; ?></td>
                        <td><?php echo $row['Descripcion']; ?></td>
                        <td><?php echo $row['Cantidad']; ?></td>
                        <td><?php echo $row['codMaquina']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                      </tr>
                <?php
                    }
                  }
                } ?>
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
      <h6 class="m-0 font-weight-bold text-gray-800">Reporte Inventario de Repuestos</h6>
    </a>
    <div class="collapse" id="ReporteInventarioActualizado">
      <div class="table-responsive">
        <div class="card shadow">
          <div class="card-body">
            <div class="m-0 p-0">
              <table id="Tbl_Reporte_Inventario" class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th><label>Código</label></th>
                    <th><label>Descripción</label></th>
                    <th><label>Cantidad</label></th>
                    <th><label>Medida</label></th>
                  </tr>
                </thead>

                <?php include_once('includes/conexion.php'); ?>
                <?php
                if (!$conex) {
                  echo 'NoConex';
                } else {
                  $queryInventario = "SELECT r.Codigo, r.Descripcion, ri.Cantidad, r.Medida FROM repuesto_inventario AS ri INNER JOIN repuesto AS r on r.Codigo = ri.Codigo GROUP BY r.Codigo;";

                  $result = mysqli_query($conex, $queryInventario);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                      <tr>
                        <td><?php echo $row['Codigo']; ?></td>
                        <td><?php echo $row['Descripcion']; ?></td>
                        <td><?php echo $row['Cantidad']; ?></td>
                        <td><?php echo $row['Medida']; ?></td>
                      </tr>
                <?php
                    }
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


<script src="js/Repuestos_Reportes.js"></script>

</body>

</html>