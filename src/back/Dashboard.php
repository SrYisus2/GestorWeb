<?php
include_once('../includes/conexion.php');
if (!$conex) {
  $repuesta = 'NoConex';
} else {
  $datos = $_REQUEST['datos'];
  $op = $datos[0];
  $respuesta = false;


  switch ($op) {
    case 'ingresoMensualCombustible':
      $query = "SELECT SUM(cantidadlts) AS ingresoMensualCombustible
          FROM `combustible`
          WHERE fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE()) - 1 DAY)
                           AND LAST_DAY(NOW());";
      $datos = mysqli_fetch_assoc(mysqli_query($conex, $query));
      $respuesta = $datos['ingresoMensualCombustible'];

      break;

    case 'consumoMensualCombustible':
      $query = "SELECT SUM(cantidadlts) AS consumoMensualCombustible FROM `combustible_insumo` WHERE fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE()) - 1 DAY) AND LAST_DAY(NOW());";
      $datos = mysqli_fetch_assoc(mysqli_query($conex, $query));
      $respuesta = $datos['consumoMensualCombustible'];

      break;

    case 'MaquinariaDisponible':
      $query = "SELECT ROUND((((SELECT COUNT(Id) FROM maquinaria WHERE Estado = 1) / (SELECT COUNT(Id) FROM maquinaria)) * 100), 0) AS MaquinariaDisponible;";
      $datos = mysqli_fetch_assoc(mysqli_query($conex, $query));
      $respuesta = $datos['MaquinariaDisponible'];

      break;

    case 'SoliRepuestoPendiente':
      $query = "SELECT COUNT(id) AS SoliRepuestoPendiente FROM `repuesto_solicitud` WHERE estado = 0;";
      $datos = mysqli_fetch_assoc(mysqli_query($conex, $query));
      $respuesta = $datos['SoliRepuestoPendiente'];

      break;

    case 'RevisarMaquina':
      $query = "SELECT * FROM `maquinaria` WHERE Codigo = '$datos[1]';";
      $respuesta = json_encode(mysqli_fetch_assoc(mysqli_query($conex, $query)), JSON_UNESCAPED_UNICODE);

      break;

    case 'seguimientoSolicitud':
      $table['table'] = '<div class="card shadow-lg mt-2">
                        <div class="card-body">
                            <div class="table-responsiv-lg">
                                <table id="tblVerSolicitudes" class="table table-hover table-sm w-100">
                                    <thead>
                                        <tr>
                                            <th><label># Máquina</label></th>
                                            <th><label>Código Repuesto</label></th>
                                            <th><label>Descripcion</label></th>
                                            <th><label>Cantidad</label></th>
                                            <th><label>Medida</label></th>
                                            <th><label>Estado</label></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

      $query = "SELECT rs.fecha, m.Codigo AS codMaquina, r.Codigo AS codRepuesto, r.Descripcion, rsd.cantidad, r.Medida, rsd.estado FROM repuesto_solicituddetalle rsd INNER JOIN  repuesto_solicitud rs ON rs.id = rsd.idSolicitud INNER JOIN repuesto r ON r.id = rsd.idRepuesto INNER JOIN maquinaria m ON m.id = rsd.idMaquina WHERE rsd.idSolicitud = $datos[1]";

      $datos = mysqli_query($conex, $query);

      if (mysqli_num_rows($datos) > 0) {
        while ($linea = mysqli_fetch_assoc($datos)) {
          $table['fecha'] = $linea['fecha'];
          $table['table'] .= "<tr>";
          $table['table'] .= "<td>" . $linea['codMaquina'] . "</td>";
          $table['table'] .= "<td>" . $linea['codRepuesto'] . "</td>";
          $table['table'] .= "<td>" . $linea['Descripcion'] . "</td>";
          $table['table'] .= "<td>" . $linea['cantidad'] . "</td>";
          $table['table'] .= "<td>" . $linea['Medida'] . "</td>";
          $table['table'] .= "<td>" . $estado = ($linea['estado']) ? '<span class="badge badge-success">Comprado</>' : '<span class="badge badge-info">Pendiente</>' . "</td>";
          $table['table'] .= "</tr>";
        }

        $table['table'] .= "</table>
                </div>
                </div>
                </div>";

        $respuesta = json_encode($table, JSON_UNESCAPED_UNICODE);
      } else {
        $respuesta = 0;
      }
      break;

    case 'existenciaRepuesto':
      $table['table'] = '<div class="card shadow-lg mt-2">
                            <div class="card-body">
                                <div class="table-responsiv-lg">
                                    <table id="tblexistenciaRepuesto" class="table table-hover table-sm w-100">
                                        <thead>
                                            <tr>
                                                <th><label>Código Repuesto</label></th>
                                                <th><label>Descripcion</label></th>
                                                <th><label>Cantidad</label></th>
                                                <th><label>Medida</label></th>
                                            </tr>
                                        </thead>
                                        <tbody>';

      $query = "SELECT r.Codigo, r.Descripcion, ri.Cantidad, r.Medida FROM repuesto_inventario AS ri INNER JOIN repuesto AS r on r.Codigo = ri.Codigo WHERE r.Codigo LIKE '%" . $datos[1] . "%' OR r.Descripcion LIKE '%" . $datos[1] . "%' GROUP BY r.Codigo;";


      $datos = mysqli_query($conex, $query);

      if (mysqli_num_rows($datos) > 0) {
        while ($linea = mysqli_fetch_assoc($datos)) {
          $table['fecha'] = $linea['fecha'];
          $table['table'] .= "<tr>";
          $table['table'] .= "<td>" . $linea['Codigo'] . "</td>";
          $table['table'] .= "<td>" . $linea['Descripcion'] . "</td>";
          $table['table'] .= "<td>" . $linea['Cantidad'] . "</td>";
          $table['table'] .= "<td>" . $linea['Medida'] . "</td>";
          $table['table'] .= "</tr>";
        }

        $table['table'] .= "</table>
                    </div>
                    </div>
                    </div>";

        $respuesta = json_encode($table, JSON_UNESCAPED_UNICODE);
      } else {
        $respuesta = 0;
      }
      break;
  }

  if (is_null($respuesta)) {
    $respuesta = 0;
  }

  mysqli_close($conex);
  echo $respuesta;
}
