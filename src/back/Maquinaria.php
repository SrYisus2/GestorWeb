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
               $Codigo = trim(strtoupper($datos[1]));
               $Descripcion = trim(strtoupper($datos[2]));
               $Marca = trim(strtoupper($datos[3]));
               $Modelo = trim(strtoupper($datos[4]));
               $Estado = 1;

               $query = "INSERT INTO maquinaria (Codigo, Descripcion, Marca, Modelo, Estado) VALUES ('" . $Codigo . "', '" . $Descripcion . "', '" . $Marca . "', '" . $Modelo . "'," . $Estado . ")";

               if (mysqli_query($conex, $query)) {
                    $repuesta = true;
               }
               break;

          case 'actualizar':
               $Codigo = trim(strtoupper($datos[1]));
               $Descripcion = trim(strtoupper($datos[2]));
               $Marca = trim(strtoupper($datos[3]));
               $Modelo = trim(strtoupper($datos[4]));

               $query = "UPDATE maquinaria SET Descripcion = '$Descripcion', Marca = '$Marca', Modelo = '$Modelo' WHERE Codigo = '$Codigo'";

               if (mysqli_query($conex, $query)) {
                    $repuesta = true;
               }

               break;

          case 'eliminar':
               $Codigo = trim(strtoupper($datos[1]));

               $query = "UPDATE maquinaria SET Estado = 0 WHERE Id = $Codigo";

               if (mysqli_query($conex, $query)) {
                    $repuesta = true;
               }

               break;

          case 'habilitar':
               $Codigo = trim(strtoupper($datos[1]));

               $query = "UPDATE maquinaria SET Estado = 1 WHERE Id = $Codigo";

               if (mysqli_query($conex, $query)) {
                    $repuesta = true;
               }

               break;

          case 'buscar':
               $Codigo = trim(strtoupper($datos[1]));

               $query = "SELECT * FROM maquinaria WHERE Id = $Codigo";
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
