 <?php
     session_start();
     //Comprobamos si esta definida la sesión 'tiempo'.
     if(isset($_SESSION['tiempo']) ) {

          $Uname = $_SESSION['Uname']; 
          $Urol = $_SESSION['Urol'];
          $Tiempo = $_SESSION['tiempo'];

          //Tiempo en segundos para dar vida a la sesión.
          $inactivo = 1200; // 20min en este caso.

          //Calculamos tiempo de vida inactivo.
          $vida_session = time() - $Tiempo;

          if(!isset($Uname)){
               header("location: ../src/index.php");
          }

          //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
          if($vida_session > $inactivo) {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            header("Location: ../index/index.html");

            exit();
          }
     } 
     else {
         
          //Activamos sesion tiempo.
          //$_SESSION['tiempo'] = time();
          //$Uname = $_SESSION['Uname']; 
          //$Urol = $_SESSION['Urol'];

          //if(!isset($Uname)){
               header("location: ../src/index.php");
          //}
     }
 $_SESSION['tiempo'] = time();
     
     
?>