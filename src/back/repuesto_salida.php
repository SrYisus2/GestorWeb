<?php
include_once('../includes/conexion.php');
if (!$conex) {
     $respuesta = 'NoConex';
} else {
     $datos = $_REQUEST['datos'];
     $respuesta = false;


     foreach ($datos as $fila => $dato) {
          $query = "INSERT INTO repuesto_salida (Fecha, idRepuesto, Cantidad, idMaquina, idResponsable) VALUES ('$dato[0]', $dato[1], $dato[2], $dato[3], $dato[4]);";

          if (mysqli_query($conex, $query)) {
               $query = "UPDATE repuesto_inventario SET Cantidad = Cantidad - $dato[2] WHERE Id = $dato[1];";

               $respuesta = mysqli_query($conex, $query);
          }
     }

     mysqli_close($conex);
     echo $respuesta;
}
