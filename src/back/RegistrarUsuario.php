<?php
// INSERTA LA INFORMACION EN LA TABLA REPUESTOS
include_once('../includes/conexion.php');

// Valida si se hizo bien la conexión con la base de datos
if (!$conex) {
     $respuesta = 'NoConex';
} else {
     // Saneamiento de datos (ejemplo usando prepared statements)
     $Nombre = mysqli_real_escape_string($conex, $_POST['Nombre']);
     $Email = mysqli_real_escape_string($conex, $_POST['Email']);
     $Password = mysqli_real_escape_string($conex, $_POST['Password']);

     // Consulta para verificar si el email ya existe
     $stmt = $conex->prepare("SELECT * FROM usuario WHERE Email = ?");
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows > 0) {
          $respuesta = 'email';
     } else {
          // Inserta los datos en la base de datos
          $stmt = $conex->prepare("INSERT INTO usuario (Nombre, Email, Password, ultimoIngreso) VALUES (?, ?, ?, NOW())"); // Asume que el rol por defecto es 2
          $stmt->bind_param("sss", $Nombre, $Email, $Password);

          if ($stmt->execute()) {
               $respuesta = true;
          } else {
               $respuesta = false;
          }
          $stmt->close();
     }

     // Cierra la conexión
     mysqli_close($conex);

     echo $respuesta;
}
