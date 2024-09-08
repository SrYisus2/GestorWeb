<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="Jairo Pérez Rodríguez" content="">
     <link href="img/icono.ico" rel="icon">
     <title>Registrarse</title>

     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

     <link href="css/sb-admin-2.min.css" rel="stylesheet">
     <link rel='stylesheet' href='vendor/SweetAlert/sweetalert2.min.css' type='text/css'>
</head>

<body class="bg-gradient-danger">
     <div class="container">
          <div class="card o-hidden border-0 shadow-lg my-5">
               <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                         <div class="col-lg-5  d-none d-lg-block bg-register-image"></div>
                         <div class="col-lg-7">
                              <div class="p-5">
                                   <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrarse</h1>
                                   </div>
                                   <form class="user">
                                        <div class="form-group">
                                             <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nombre Completo">
                                        </div>
                                        <div class="form-group">
                                             <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Correo Electrónico">
                                        </div>
                                        <div class="form-group row">
                                             <div class="col-sm-6 mb-3 mb-sm-0">
                                                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Contraseña">
                                             </div>
                                             <div class="col-sm-6">
                                                  <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repetir Contraseña">
                                             </div>
                                        </div>
                                        <a href="Login.php" id="btnRegistrarse" class="btn btn-primary btn-user btn-block"> Registrarse </a>
                                        <hr>
                                   </form>
                                   <hr>
                                   <div class="text-center">
                                        <a class="small" href="index.php">Iniciar sesión</a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Bootstrap core JavaScript-->
     <script src="vendor/jquery/jquery.min.js"></script>
     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

     <!-- Custom scripts for all pages-->
     <script src="js/sb-admin-2.min.js"></script>
     <script src='vendor/SweetAlert/sweetalert2.min.js' type='text/javascript'></script>

     <script type='text/javascript'>
          $(document).ready(function() {
               $('#btnRegistrarse').click(function(e) {
                    e.preventDefault();

                    if ($('#exampleFirstName').val() != '' && $('#exampleInputEmail').val() != '' && $('#exampleInputPassword').val() != '' && $('#exampleRepeatPassword').val() != '') {
                         var datos = "Nombre=" + $('#exampleFirstName').val() +
                              "&Email=" + $('#exampleInputEmail').val() +
                              "&Password=" + $('#exampleInputPassword').val() +
                              "&rPassword=" + $('#exampleRepeatPassword').val();
                              
                         $.post('back/RegistrarUsuario.php', datos, function(Respuesta) {
                              if (Respuesta == 'NoConex') {
                                   Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Error de Conexión con la BD, consulte al Administrador',
                                        showConfirmButton: false,
                                        timer: 1500
                                   });
                              } else if (Respuesta == 'email') {
                                   Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Email ya se encuantra asociado a un usuario',
                                        showConfirmButton: false,
                                        timer: 2000
                                   });
                              } else if (Respuesta == true) {
                                   Swal.fire({
                                        position: 'center',
                                        type: 'success',
                                        title: 'Registro Satisfactorio',
                                        showConfirmButton: false,
                                        timer: 1500
                                   });
                                   setTimeout("location.href='index.php'", 1501);
                              } else {
                                   Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Registro incorrecto. Consulte al Administrador al correo alvarodmg0306@hotmail.com',
                                        showConfirmButton: false,
                                        timer: 2500
                                   });
                              }
                         });
                    } else {
                         Swal.fire({
                              position: 'center',
                              type: 'error',
                              title: 'Complete toda la información, por favor',
                              showConfirmButton: false,
                              timer: 1500
                         });
                    }
               });
          });
     </script>

</body>

</html>