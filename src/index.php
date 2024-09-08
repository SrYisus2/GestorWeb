<!DOCTYPE html>
<html lang="es" >

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <title>Ingreso</title>
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="css/sb-admin-2.min.css" rel="stylesheet" type='text/css'>
     <link href='vendor/SweetAlert/sweetalert2.min.css' rel='stylesheet' type='text/css'>
</head>

<body class="background">
     <div class="container w-25">
          <div class="row justify-content-center">
               <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="o-hidden border-0 shadow-lg my-5">
                         <div class="p-0">
                              <div class="row">
                                   <div class="col-md-12">
                                        <div class="p-5">
                                             <div class="text-center">
                                                  <h1 class="h4 text-gray-900 mb-4"><strong>Bienvenido</strong></h1>
                                             </div>
                                             <form class="user">
                                                  <div class="form-group">
                                                       <input id="txtEmail" type="text" name='email' class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Correo">
                                                  </div>
                                                  <div class="form-group">
                                                       <input id="txtPassword" type="password" name='password' class="form-control form-control-user" placeholder="Contraseña">
                                                  </div>
                                                  <button id="btnIngresar" type="submit" class="btn btn-warning btn-user btn-block">Ingresar</button>
                                                  <hr>
                                             </form>
                                             </div>
                                             <div class="text-center">
                                                  <a class="small" href="Registrarse.php">Registrarme</a>
                                             </div>
                                        </div>
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
     <script src="js/utils.js"></script>

     <script type="text/javascript">
          $(document).ready(function() {
               $('#btnIngresar').click(function(e) {
                    e.preventDefault();
                    if ($('#txtEmail').val() != '' && $('#txtPassword').val() != '') {
                         var datos = "email=" + $('#txtEmail').val() + "&password=" + $('#txtPassword').val();

                         $.post('back/Ingresar.php', datos, function(respuesta) {
                              console.log(respuesta);
                              if (respuesta == 'NoConex') {
                                   msgErrorConexion()
                                   return false;
                              } else if (respuesta == 1) {
                                   window.location = 'dashboard.php';
                              } else if (respuesta == 'ErrorPass') {
                                   $('#txtPassword').focus();
                                   mensaje('top', 1500, 'error', 'Contraseña incorrecta')
                              } else if (respuesta == 'errorUser') {
                                   $('#txtEmail').focus();
                                   mensaje('top', 1500, 'error', 'Usuario o email inválido')
                              }
                         });
                    } else {
                         $('#txtEmail').focus();
                         Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: 'Por favor',
                              text: 'Complete todos los campos',
                              showConfirmButton: true,
                         });
                    }
               });
          });
     </script>

</body>

</html>