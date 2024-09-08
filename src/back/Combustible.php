<?php
// INSERTA LA INFORMACION EN LA TABLA REPUESTOS
include_once('../includes/conexion.php');
// VALIDA SI SE HIZO BIEN LA CONEXION CON LA BASE DE DATOS
if (!$conex) {
     $respuesta = 'NoConex';
} else {
     $datos = $_REQUEST['datos'];
     $op = $datos[0];
     $respuesta = false;

     switch ($op) {
          case 'insertar':
               $fecha = trim($datos[1]);
               $boleta = trim($datos[2]);
               $cantidadlts = trim($datos[3]);
               $idDespachador = trim($datos[4]);

               $query = "INSERT INTO combustible (fecha, boleta, cantidadlts, idDespachador, estado) VALUES ('" . $fecha . "', '" . $boleta . "', " . $cantidadlts . ", '" . $idDespachador . "', 1)";

               if (mysqli_query($conex, $query)) {
                    $id = mysqli_insert_id($conex);

                    $query = "INSERT INTO combustible_inventario (idCombustible, saldolts) VALUES (" . $id . ", " . $cantidadlts . ")";

                    if (mysqli_query($conex, $query)) {
                         $respuesta = true;
                    }
               }
               break;

          case 'eliminar':
               $id = trim($datos[1]);

               $query = "DELETE FROM combustible_inventario WHERE idCombustible = $id";

               if (mysqli_query($conex, $query)) {
                    $query = "DELETE FROM combustible WHERE id = $id";

                    if (mysqli_query($conex, $query)) {
                         $respuesta = true;
                    }
               }
               break;
     }

     mysqli_close($conex);
     echo $respuesta;
}
