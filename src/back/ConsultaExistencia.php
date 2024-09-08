<?php
     // INSERTA LA INFORMACION EN LA TABLA REPUESTOS
     include_once('../includes/conexion.php');
     // VALIDA SI SE HIZO BIEN LA CONEXION CON LA BASE DE DATOS
     if(!$conex){
           echo 'NoConex';
     }else{
          // OBTIENE LA INFORMACION QUE SE HIZO EN EL POST
          $Codigo = $_POST['Codigo'];
          // RECORRE EL ARRAY DE FILAS PARA IR INSERTANDO DATO POR DATO
          $query = "SELECT Cantidad FROM repuesto_inventario WHERE Codigo = '$Codigo'";
          $result = mysqli_query($conex, $query);
          if (mysqli_num_rows($result) > 0) {
               while($row = mysqli_fetch_assoc($result)) {
                    echo $row["Cantidad"];
               }
          }
          // CIERRA LA CONEXION
          mysqli_close($conex);
     }
