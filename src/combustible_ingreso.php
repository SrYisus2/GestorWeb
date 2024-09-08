<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro de Combustible</title>
    <?php include_once("includes/head.php"); ?>
</head>

<?php include_once("includes/bodyHead.php"); ?>

<div class="container-fluid">
    <div class="card shadow mb-1">
        <a href="#CardRegistroCombustible" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardRegistroCombustible">
            <h6 class="m-0 font-weight-bold text-black-50">Registro de Combustible</h6>
        </a>
        <div class="collapse show" id="CardRegistroCombustible">
            <section class='pt-2 card card-header'>
                <div class='row'>
                    <div class='col-md-3'>
                        <label>Fecha</label>
                        <div class="form-group">
                            <input type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control validar" ID="Fecha" name='Fecha' required>
                        </div>
                    </div>

                    <div class='col-md-3'>
                        <label># Boleta</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="boleta" PlaceHolder="# Boleta" name='boleta' required>
                        </div>
                    </div>

                    <div class='col-md-3'>
                        <label>Cantidad de Litros</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="cantidadLts" PlaceHolder="Cantidad Lts" name='cantidadLts' required>
                        </div>
                    </div>

                    <div class='col-md-3'>
                        <label>Despachador</label>
                        <div class="input-group">
                            <input type="hidden" ID="idDespachador" name='idDespachador' value="0">
                            <span>
                                <button data-target="#ModalDespachador" data-toggle="modal" id="BtnModalDespachador" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" class="form-control validar mr-1" ID="Despachador" PlaceHolder="Despachador" name='Despachador' required>
                            <span>
                                <button id="BtnGuardarCombustible" type="submit" class="ui icon yellow button">Guardar</button>
                            </span>
                            <span>
                                <button id="BtnActualizarCombustible" class="d-none ui instagram button">Actualizar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- TABLA DE MAQUINARIA -->
    <div id="Tbl_CombRegistro"></div>
    <!-- FIN TABLA DE MAQUINARIA -->

    <!-- MODAL DESPACHADOR -->
    <div id="ModalDespachador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Lista de Despachadores</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="ModalDespa"></div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button id="BtnCerrarModal" type="button" class="btn btn-primary btn-custom" data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL DESPACHADOR -->

</div>

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>
<script src="js/Combustible_Ingreso.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#Tbl_CombRegistro').load('tables/tblCombustible.php');
    });
</script>

</body>

</html>