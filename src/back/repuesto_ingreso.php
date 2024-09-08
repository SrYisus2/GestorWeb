<?php
include_once('../includes/conexion.php');
if (!$conex) {
  echo 'NoConex';
} else {
  $datos = $_REQUEST['datos'];
  $op = $datos[0]['op'];
  $respuesta = 0;

  switch ($op) {
    case 'BuscarnSolicitud':
      $query = "SELECT m.Id AS idMaquina, m.Codigo AS codMaquina, r.id AS idRepuesto, r.Codigo AS codRepuesto, r.Descripcion AS descriRepuesto, rsd.cantidad, r.Medida, rsd.estado 
               FROM repuesto_solicitud rs 
               INNER JOIN repuesto_solicituddetalle rsd ON rsd.idSolicitud = rs.id 
               INNER JOIN repuesto r ON r.id = rsd.idRepuesto 
               INNER JOIN maquinaria m ON m.id = rsd.idMaquina
               WHERE rsd.idSolicitud = " . $datos[0]['idSolicitud'] . " AND rsd.estado = 0;";

      $response = mysqli_query($conex, $query);
      $respuesta = json_encode(mysqli_fetch_all($response), JSON_UNESCAPED_UNICODE);
      break;

    case 'ingresoRepuesto':
      foreach ($datos as $fila => $dato) {
        $query = "UPDATE repuesto_solicituddetalle SET estado = 1 WHERE idSolicitud = " . $dato['idSolicitud'] . " AND idRepuesto = " . $dato['idRepuesto'] . " AND idMaquina = " . $dato['idMaquina'];

        if (mysqli_query($conex, $query)) {
          $query = "INSERT INTO repuesto (Fecha, Codigo, Descripcion, Cantidad, Medida, Comprobante) VALUES ( (SELECT NOW()), '" . $dato['codRepuesto'] . "', '" . $dato['Descripcion'] . "', " . $dato['Cantidad'] . ", '" . $dato['Medida'] . "', '" . $dato['nComprobante'] . "');";

          if (mysqli_query($conex, $query)) {
            $respuesta = 1;
          }
        }
      }

      $query = "SELECT COUNT(id) AS LineasFaltantes FROM repuesto_solicituddetalle WHERE idSolicitud = " . $datos[0]['idSolicitud'] . " AND estado = 0";
      $response = mysqli_fetch_assoc(mysqli_query($conex, $query));

      if ($respuesta = 1 && $response['LineasFaltantes'] == 0) {
        $query = "UPDATE repuesto_solicitud SET estado = 1 WHERE id = " . $datos[0]['idSolicitud'];

        if (mysqli_query($conex, $query)) {
          $respuesta = 1;
        }
      }
      break;

    case 'registroRepuesto':
      $dato = $datos[0];

      $query = "INSERT INTO repuesto (Fecha, Codigo, Descripcion, Cantidad, Medida) VALUES ( (SELECT NOW()), UPPER('" . $dato['codRepuesto'] . "'), UPPER('" . $dato['Descripcion'] . "'), 0, '" . $dato['Medida'] . "');";

      if (mysqli_query($conex, $query)) {
        $respuesta = 1;
      }
      break;
  }

  mysqli_close($conex);
  echo $respuesta;
}
