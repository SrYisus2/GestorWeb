<!DOCTYPE html>
<html lang="en">

<head>
     <title>Registro de Maquinaria</title>
     <?php include_once("includes/head.php"); ?>
</head>

<?php include_once("includes/bodyHead.php"); ?>

<div class="container-fluid">
     <div class="card shadow mb-1">
          <a href="#CardRegistroMaquina" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardRegistroMaquina">
               <h6 class="m-0 font-weight-bold text-black-50">Registro de Maquinaria</h6>
          </a>
          <div class="collapse show" id="CardRegistroMaquina">
               <section class='pt-2 card card-header'>
                    <div class='row'>
                         <div class='col-md-3'>
                              <label>Código</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar" ID="txtCodigo" PlaceHolder="Código" name='Codigo' required>
                              </div>
                         </div>

                         <div class='col-md-3'>
                              <label>Descripción</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar" ID="txtDescripcion" PlaceHolder="Descripción" name='Descripcion' required>
                              </div>
                         </div>

                         <div class='col-md-3'>
                              <label>Marca</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar" ID="txtMarca" PlaceHolder="Marca" name='Marca' required>
                              </div>
                         </div>

                         <div class='col-md-3'>
                              <label>Modelo</label>
                              <div class="input-group">
                                   <input type="text" class="form-control validar mr-1" ID="txtModelo" PlaceHolder="Modelo" name='Modelo' required>
                                   <span>
                                        <button id="BtnGuardarMaquina" type="submit" class="ui icon yellow button">Guardar</button>
                                   </span>
                                   <span>
                                        <button id="BtnActualizarMaquina" class="d-none ui instagram button">Actualizar</button>
                                   </span>
                              </div>
                         </div>
                    </div>
               </section>
          </div>
     </div>

     <!-- TABLA DE MAQUINARIA -->
     <div id="Tbl_MaqRegistro"></div>
     <!-- FIN TABLA DE MAQUINARIA -->

</div>

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>
<script src="js/Maquinaria_Registro.js" type="text/javascript"></script>

<script type="text/javascript">
     $(document).ready(function() {
          $('#Tbl_MaqRegistro').load('tables/tblMaquinaria.php');
     });
</script>

</body>

</html>