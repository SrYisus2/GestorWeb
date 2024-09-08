<!DOCTYPE html>
<html lang="en">

<head>
     <title>Principal</title>
     <?php
     include_once("includes/head.php");
     ?>
</head>

<?php
include_once("includes/bodyHead.php");
?>
<!-- PONER PAGINAS AQUI -->
<div class="container-fluid">
     <!-- INFORMACION -->
     <div class="row mt-3">
          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-primary shadow h-100 py-2 bg-gray-100">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="font-weight-bold text-primary text-uppercase mb-1">Ingreso Mensual de Combustible</div>
                                   <div id="ingresoMensualCombustible" class="h6 mb-0 font-weight-bold text-gray-800 IngresoMensualCombustible"></div>
                              </div>
                              <div class="col-auto">
                                   <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="font-weight-bold text-success text-uppercase mb-1">Consumo Mensual de Combustible</div>
                                   <div id="consumoMensualCombustible" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                   <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-info shadow h-100 py-2 bg-gray-100">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="font-weight-bold text-info text-uppercase mb-1">Maquinaria Disponible</div>
                                   <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                             <div id="MaquinariaDisponible" class="h6 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col">
                                             <div class="progress progress-sm mr-2">
                                                  <div id="barMaquinariaDisponible" class="progress-bar bg-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-auto">
                                   <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="font-weight-bold text-warning text-uppercase mb-1">Solicitud de Repuestos Pendientes</div>
                                   <div id="SoliRepuestoPendiente" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                   <i class="fas fa-comments fa-2x text-gray-400"></i>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- CONSULTAS -->
     <div class="row">
          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card shadow h-100 py-2">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="card-body">
                                        <div class="mb-3">
                                             <label for="codMaquina" class="form-label">Consúlte el estado de un activo</label>
                                             <div class="input-group">
                                                  <input type="text" class="form-control" id="codMaquina" name="codMaquina" placeholder="Código de máquina" required="required">
                                                  <div class="input-group-append">
                                                       <span id="BtnModalRevisarMaquina" class="input-group-text bg-warning"><a href="#"><i class="fas fa-search text-white"></i></a></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card shadow h-100 py-2">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="card-body">
                                        <div class="mb-3">
                                             <label for="seguimientoSolicitud" class="form-label">Consúlte el estado de una solicitud de repuesto</label>
                                             <div class="input-group">
                                                  <input type="text" class="form-control" id="seguimientoSolicitud" name="seguimientoSolicitud" placeholder="# de Solicitud" required="required">
                                                  <div class="input-group-append">
                                                       <span id="btnRevisarSolicitud" class="input-group-text bg-warning"><a href="#"><i class="fas fa-search text-white"></i></a></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
               <div class="card shadow h-100 py-2">
                    <div class="card-body">
                         <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                   <div class="card-body">
                                        <div class="mb-3">
                                             <label for="existenciaRepuesto" class="form-label">Consúlte el stock de un repuesto</label>
                                             <div class="input-group">
                                                  <input type="text" class="form-control" id="existenciaRepuesto" name="existenciaRepuesto" placeholder="Nombre o código" required="required">
                                                  <div class="input-group-append">
                                                       <span id="btnRevisarExistenciaRepuesto" class="input-group-text bg-warning"><a href="#"><i class="fas fa-search text-white"></i></a></span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- MODAL MAQUINARIA -->
     <div id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
          <div class="modal-dialog modal-xl" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h3 class="modal-title" id="myModalLabel"></h3>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                         <div id="BodyModal"></div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="ui button yellow" data-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>
               </div>
          </div>
     </div>

</div>
<!-- FIN PONER PAGINAS AQUI -->

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>
<script src="js/Dashboard.js" type="text/javascript"></script>

</body>

</html>