<?php
require_once('../includes/conexion.php');
if (!$conex) {
     echo 'NoConex';
} else {
     if (isset($_POST)) {
          session_start();
          $email = $_POST['email'];
          $password = $_POST['password'];

          $query = "SELECT u.usuario, u.nombre, u.email, u.password, r.nombre AS Rol FROM usuario u INNER JOIN rol r ON r.id = u.idRol WHERE u.password = '$password' AND u.usuario = '$email' OR u.email = '$email'";

          $datos = mysqli_query($conex, $query);
          $user = mysqli_fetch_assoc($datos);

          if ($email == $user['email'] || $email == $user['usuario']) {
               if ($password != $user['password']) {
                    $repuesta = 'ErrorPass';
               } else {
                    $query = "UPDATE usuario SET ultimoIngreso = NOW() WHERE usuario = '$email' OR email = '$email'";
                    mysqli_query($conex, $query);
                    $_SESSION['Uname'] = $user['nombre'];
                    $_SESSION['Urol'] = $user['Rol'];
                    $_SESSION['tiempo'] = time();
                    $repuesta = 1;
               }
          } else {
               $repuesta = 'errorUser';
          }

          mysqli_close($conex);
          echo $repuesta;
     }
}
