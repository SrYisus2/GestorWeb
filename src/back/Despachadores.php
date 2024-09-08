<?php
// INSERTA LA INFORMACION EN LA TABLA REPUESTOS
include_once('../includes/conexion.php');
// VALIDA SI SE HIZO BIEN LA CONEXION CON LA BASE DE DATOS
if (!$conex) {
    $repuesta = 'NoConex';
} else {
    $datos = $_REQUEST['datos'];
    $op = $datos[0];
    $repuesta = false;

    switch ($op) {
        case 'insertar':
            $identificacion = trim($datos[1]);
            $nombre = trim(strtoupper($datos[2]));
            $telefono = trim($datos[3]);
            $Estado = 1;

            $query = "INSERT INTO despachador (identificacion, nombre, telefono, estado) VALUES ('" . $identificacion . "', '" . $nombre . "', '" . $telefono . "'," . $Estado . ")";

            if (mysqli_query($conex, $query)) {
                $repuesta = true;
            }
            break;

        case 'actualizar':
            $id = trim($datos[1]);
            $identificacion = trim($datos[2]);
            $nombre = trim(strtoupper($datos[3]));
            $telefono = trim($datos[4]);

            $query = "UPDATE despachador SET identificacion = '$identificacion', nombre = '$nombre', telefono = '$telefono' WHERE id = $id";

            if (mysqli_query($conex, $query)) {
                $repuesta = true;
            }

            break;

        case 'eliminar':
            $id = trim($datos[1]);

            $query = "UPDATE despachador SET estado = 0 WHERE id = $id";

            if (mysqli_query($conex, $query)) {
                $repuesta = true;
            }

            break;

        case 'habilitar':
            $id = trim($datos[1]);

            $query = "UPDATE despachador SET estado = 1 WHERE id = $id";

            if (mysqli_query($conex, $query)) {
                $repuesta = true;
            }

            break;

        case 'buscar':
            $id = trim($datos[1]);

            $query = "SELECT id, identificacion, nombre, telefono, estado FROM despachador WHERE id = $id";
            $result = mysqli_query($conex, $query);
            $repuesta = json_encode(mysqli_fetch_assoc($result), JSON_UNESCAPED_UNICODE);

            break;

        default:
            # code...
            break;
    }


    mysqli_close($conex);
    echo $repuesta;
}
