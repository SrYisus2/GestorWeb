<!DOCTYPE html>
<html lang="en">

<head>
     <title>Registro de Repuestos</title>
     <?php include_once("includes/head.php"); ?>
</head>
<?php include_once("includes/bodyHead.php"); ?>

<div class="container-fluid">
     <!-- <div class="card shadow mb-1">
          <a href="#CardRegistroRepuesto" class="d-block card-header py-3 collapsed text-black-50" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="CardRegistroRepuesto">
               <h6 class="m-0 font-weight-bold">Registro de Repuestos</h6>
          </a>
          <div class="collapse" id="CardRegistroRepuesto">
               <section class='pt-2 card card-header'>
                    <div class="row">
                         <div class="col-md-2">
                              <label>Fecha</label>
                              <div class="form-group">
                                   <input type="date" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control validar" ID="Fecha" name='Fecha'>
                              </div>
                         </div>

                         <div class='col-md-2'>
                              <label>Código Repuesto</label>
                              <div class="input-group">
                                   <input type="hidden" ID="idCodRepuesto" name='idCodRepuesto' value="0">
                                   <input type="text" class="form-control validar" ID="codRepuesto" PlaceHolder="Código" name='codRepuesto'>
                                   <span>
                                        <button data-target="#ModalRepuestos" data-toggle="modal" id="BtnModalRepuesto" class="btn btn-secondary" title="Buscar Repuesto"><i class="fa fa-search"></i></button>
                                   </span>
                              </div>
                         </div>

                         <div class='col-md-3'>
                              <label>Descripción</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar" ID="Descripcion" PlaceHolder="Descripción" name='Descripcion'>
                              </div>
                         </div>

                         <div class='col-md-1'>
                              <label>Cantidad</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar" ID="Cantidad" name='Cantidad' placeholder="Cantidad">
                              </div>
                         </div>

                         <div class='col-md-2'>
                              <label>Medida</label>
                              <div class="input-group">
                                   <select id="selectMedida" name="selectMedida" class="form-control custom-select">
                                        <option value="0" selected>Seleccione una opción</option>
                                        <option value="UNIDAD">UNIDAD</option>
                                        <option value="MTS">METRO</option>
                                        <option value="KG">KILO</option>
                                        <option value="LITRO">LITRO</option>
                                   </select>
                              </div>
                         </div>

                         <div class='col-md-2'>
                              <label>Comprobante</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar mr-1" ID="Comprobante" PlaceHolder="Comprobante" name='Comprobante'>
                                   <span>
                                        <button id="BtnAgregarLinea" class="ui button yellow">Agregar</button>
                                   </span>
                                   <span>
                                        <button id="BtnActualizarLinea" class="ui instagram button d-none">Actualizar</button>
                                   </span>
                              </div>
                         </div>
                    </div>
               </section>
          </div>
     </div> -->

     <div class="row">
          <div class="col-md-2">
               <input type="text" class="form-control validar mr-1" ID="nSolicitud" PlaceHolder="Número de Solicitud" name='nSolicitud'>
          </div>
          <div class="col-md-2">
               <button id="BtnBuscarnSolicitud" class="ui button yellow">Buscar</button>
          </div>
     </div>

     <!-- TABLA -->
     <div class="card shadow-lg mt-3">
          <div class="card-body">
               <div class="table-responsive">
                    <table id="Tbl_RegistroRepuesto" class="table table-hover table-sm w-100">
                         <thead>
                              <tr>
                                   <th class="d-none"></th>
                                   <th><label>Código Máquina</label></th>
                                   <th class="d-none"></th>
                                   <th><label>Código</label></th>
                                   <th><label>Descripción</label></th>
                                   <th><label>Cantidad</label></th>
                                   <th><label>Medida</label></th>
                                   <th><label>Estado</label></th>
                                   <th><label>Comprobante</label></th>
                                   <th><label>Acciones</label></th>
                                   <th class="d-none"></th>
                              </tr>
                         </thead>
                    </table>
               </div>
          </div>
     </div>
     <!-- FIN TABLA -->

     <!-- BOTONES -->
     <section class='mt-4 input-group row'>
          <div class='col-12 float-right'>
               <button type="reset" id='btnCancelarRegistroRepuesto' class='ui button red W-25'>Cancelar</button>
               <button type='submit' id='btnGuardarRegistroRepuesto' name='Guardar' class='ui button yellow W-25'>Guardar</button>
          </div>
     </section>
     <!-- FIN BOTONES -->

     <!-- MODAL REPUESTOS -->
     <div id="ModalRepuestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h3 class="modal-title" id="myModalLabel">Lista de Repuestos</h3>
                         <button type="button" id="BtnXModalClientes" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-12">
                                   <div id="tblModalRepuestos"></div>
                              </div>
                         </div>
                         <br>
                    </div>
                    <div class="modal-footer">
                         <a class="ui button blue" href="repuestos_ingresos.php">Registar Repuesto</a>
                         <button type="button" class="ui button yellow" data-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>
               </div>

          </div>
     </div>
     <!-- FIN MODAL REPUESTOS -->

</div>

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>

<script src="js/Repuestos_Ingresos.js"></script>

</body>

</html>