<!DOCTYPE html>
<html lang="en">

<head>
  <title>Solicitud de Repuestos</title>
  <?php include_once("includes/head.php"); ?>
</head>
<?php include_once("includes/bodyHead.php"); ?>
<!-- PONER PAGINAS AQUI -->
<div class="container-fluid">
  <div class="card shadow mb-1">
    <a href="#CardSolicitudRepuestos" class="d-block card-header py-3 collapsed text-black-50" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="CardSolicitudRepuestos">
      <h6 class="m-0 font-weight-bold">Solicitud de Repuestos</h6>
    </a>
    <div class="collapse show" id="CardSolicitudRepuestos">
      <section class='pt-2 card card-header'>
        <div class='row'>
          <div class="col-md-2">
            <label>Fecha</label>
            <div class="form-group">
              <input type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control validar" ID="Fecha" name='Fecha'>
            </div>
          </div>

          <div class='col-md-2'>
            <label>Código Repuesto</label>
            <div class="input-group">
              <span>
                <button data-target="#ModalRepuestos" data-toggle="modal" id="BtnModalRepuestos" class="btn btn-secondary" title="Buscar Repuesto"><i class="fa fa-search"></i>
                </button>
              </span>
              <input type="hidden" ID="idCodRepuesto" name='idCodRepuesto'>
              <input type="text" class="form-control validar" ID="codRepuesto" PlaceHolder="Código" name='codRepuesto'>
            </div>
          </div>

          <div class='col-md-4'>
            <label>Descripción</label>
            <div class="input-group">
              <input type="text" class="form-control validar" ID="Descripcion" PlaceHolder="Descripción" name='Descripcion'>
            </div>
          </div>

          <div class='col-md-2'>
            <label>Cantidad</label>
            <div class="input-group">
              <input type="text" class="form-control validar" ID="Cantidad" placeholder="Cantidad" name='Cantidad'>
            </div>
          </div>

          <div class='col-md-2'>
            <label># Máquina</label>
            <div class="input-group">
              <span>
                <button data-target="#ModalMaquinaria" data-toggle="modal" id="BtnModalMaquinaria" class="btn btn-secondary" title="Buscar Activo"><i class="fa fa-search"></i></button>
              </span>
              <input type="hidden" ID="idMaquina" name='idMaquina'>
              <input type="text" class="form-control validar" ID="Maquina" PlaceHolder="Máquina" name='Maquina'>
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
  </div>

  <!-- TABLA -->
  <div class="card shadow-lg mt-2">
    <div class="card-body">
      <div class="table-responsive">
        <table id="Tbl_SolicitudRepuesto" class="table table-hover table-sm w-100">
          <thead>
            <tr>
              <th><label>Fecha</label></th>
              <th class="d-none"></th>
              <th><label>Código Repuesto</label></th>
              <th><label>Descripción</label></th>
              <th><label>Cantidad</label></th>
              <th class="d-none"></th>
              <th><label># Máquina</label></th>
              <th><label>Acciones</label></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!-- FIN TABLA -->

  <!-- BOTONES -->
  <section class='mt-3 input-group row'>
    <div class='col-12 float-right'>
      <button type="reset" id='btnCancelarSolicitudRepuesto' class='ui button red W-25'>Cancelar</button>
      <button type='submit' id='btnGuardarSolicitudRepuesto' name='Guardar' class='ui button yellow W-25'>Guardar</button>
    </div>
  </section>
  <!-- FIN BOTONES -->

  <!-- MODAL REPUESTOS -->
  <div id="ModalRepuestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
    <div class="modal-dialog modal-xl" role="document">
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
          <!-- <a class="ui button blue" href="repuestos_ingresos.php">Registar Repuesto</a> -->
          <a id="btnModalRegistroRepuesto" data-target="#ModalRegistroRepuesto" data-toggle="modal" class="ui button blue" href="#">Registar Repuesto</a>
          <button type="button" class="ui button yellow" data-dismiss="modal" aria-label="Close">Cerrar</button>
        </div>
      </div>

    </div>
  </div>
  <!-- FIN MODAL REPUESTOS -->

  <!-- MODAL MAQUINARIA -->
  <div id="ModalMaquinaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Lista de Maquinaria</h3>
          <button type="button" id="BtnXModalMaquinaria" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div id="tblModalMaquinaria"></div>
            </div>
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="ui button yellow" data-dismiss="modal" aria-label="Close">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN MODAL MAQUINARIA -->

  <!-- MODAL REGISTRO REPUESTOS -->
  <div id="ModalRegistroRepuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Registro de Repuesto</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <section class='pt-2'>
            <div class="row">
              <div class='col-md-3'>
                <label>Código Repuesto</label>
                <div class="input-group">
                  <input type="text" class="form-control validar" ID="modalcodRepuesto" PlaceHolder="Código" name='modalcodRepuesto'>
                </div>
              </div>

              <div class='col-md-6'>
                <label>Descripción</label>
                <div class="input-group">
                  <input type="text" class="form-control validar" ID="modalDescripcion" PlaceHolder="Descripción" name='modalDescripcion'>
                </div>
              </div>

              <div class='col-md-3'>
                <label>Medida</label>
                <div class="input-group">
                  <select id="modalselectMedida" name="modalselectMedida" class="form-control custom-select">
                    <option value="0" selected>Seleccione una opción</option>
                    <option value="UNIDAD">UNIDAD</option>
                    <option value="MTS">METRO</option>
                    <option value="KG">KILO</option>
                    <option value="LITRO">LITRO</option>
                  </select>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="modal-footer">
          <button type="button" class="ui button yellow" data-dismiss="modal" aria-label="Close">Cerrar</button>
          <a id="btnRegistroRepuesto" class="ui button blue" href="#">Guardar</a>
        </div>
      </div>

    </div>
  </div>
  <!-- FIN MODAL REGISTRO REPUESTOS -->

</div>
<!-- FIN PONER PAGINAS AQUI -->

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>

<script src="js/Repuestos_Solicitud.js"></script>

</body>

</html>