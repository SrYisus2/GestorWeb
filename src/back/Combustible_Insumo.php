<?php
include_once('../includes/conexion.php');
if (!$conex) {
    $repuesta = 'NoConex';
} else {
    $datos = $_REQUEST['datos'];
    $op = $datos[0];
    $repuesta = 0;

    switch ($op) {
        case 'insertar':
            $fecha = trim($datos[1]);
            $BoletaDesp = trim($datos[2]);
            $idMaquina = trim($datos[3]);
            $cantidadlts = trim($datos[4]);
            $idBoletaComb = trim($datos[5]);
            $idDespachador = trim($datos[6]);


            $query = "INSERT INTO combustible_insumo (fecha, BoletaDesp, idMaquina, cantidadlts, idBoletaComb, idDespachador) VALUES ('$fecha', '$BoletaDesp', $idMaquina, $cantidadlts, $idBoletaComb, $idDespachador)";

            if (mysqli_query($conex, $query)) {
                $id = mysqli_insert_id($conex);

                $query = "UPDATE combustible_inventario SET saldolts = saldolts - $cantidadlts WHERE idCombustible = $idBoletaComb";

                if (mysqli_query($conex, $query)) {
                    $query = "SELECT saldolts FROM combustible_inventario WHERE idCombustible = " . $idBoletaComb;
                    $response = mysqli_fetch_assoc(mysqli_query($conex, $query));

                    if ($response['saldolts'] == 0) {
                        $query = "UPDATE combustible SET estado = 0 WHERE id = " . $idBoletaComb;

                        if (mysqli_query($conex, $query)) {
                            $respuesta = 1;
                        }
                    }
                }
            }
            break;

        case 'eliminar':
            $id = trim($datos[1]);
            $idCombustible = trim($datos[2]);
            $cantidadlts = trim($datos[3]);

            $query = "DELETE FROM combustible_insumo WHERE id = $id";

            if (mysqli_query($conex, $query)) {
                $query = "UPDATE combustible_inventario SET saldolts = saldolts + $cantidadlts WHERE idCombustible = $idCombustible";

                if (mysqli_query($conex, $query)) {
                    $repuesta = true;
                }
            }
            break;

        case 'buscar':
            $idBoletaComb = trim($datos[1]);
            $cantidadlts = trim($datos[2]);

            $query = "SELECT saldolts FROM combustible_inventario WHERE idCombustible = $idBoletaComb";
            $datos = mysqli_query($conex, $query);
            $saldolts = mysqli_fetch_assoc($datos);

            if (intval($saldolts['saldolts']) >= intval($cantidadlts)) {
                $repuesta = true;
            }
            break;
    }

    mysqli_close($conex);
    echo $repuesta;
}
