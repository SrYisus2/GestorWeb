<?php
include_once('../includes/conexion.php');
if (!$conex) {
    $respuesta = 'NoConex';
} else {
    $datos = $_REQUEST['datos'];
    $respuesta = false;

    $query = "INSERT INTO repuesto_solicitud (fecha, estado) VALUES ('" . $datos[0]['Fecha'] . "', 0)";
    if (mysqli_query($conex, $query)) {
        $idSolicitud = mysqli_insert_id($conex);

        foreach ($datos as $fila => $dato) {
            $query = "INSERT INTO repuesto_solicituddetalle (idSolicitud, idRepuesto, cantidad, idMaquina) VALUES (" . $idSolicitud . "," . $dato['idCodRepuesto'] . "," . $dato['Cantidad'] . "," . $dato['idMaquina'] . ")";

            if (mysqli_query($conex, $query)) {
                $respuesta = true;
            }
        }
    } else {
    }

    mysqli_close($conex);
    echo $respuesta;
}