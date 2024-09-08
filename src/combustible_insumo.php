<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro Consumo de Combustible</title>
    <?php include_once("includes/head.php"); ?>
</head>
<?php include_once("includes/bodyHead.php"); ?>
<!-- PONER PAGINAS AQUI -->
<div class="container-fluid">
    <div class="card shadow mb-1">
        <a href="#CardRegistroInsumo" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CardRegistroInsumo">
            <h6 class="m-0 font-weight-bold text-black-50">Registro Insumo de Combustible</h6>
        </a>
        <div class="collapse show" id="CardRegistroInsumo">

            <section class='pt-2 card card-header'>
                <div class="row">
                    <div class="col-md-2">
                        <label>Fecha</label>
                        <div class="form-group">
                            <input type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control validar" ID="Fecha" name='Fecha'>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <label>Boleta Despacho</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="Boleta" PlaceHolder="# Boleta" name='Boleta'>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <label># Máquina</label>
                        <div class="input-group">
                            <span>
                                <button data-target="#ModalMaquinaria" data-toggle="modal" id="BtnModalMaquinaria" class="btn btn-secondary" title="Buscar Activo"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="hidden" ID="idMaquina" name='idMaquina' value="0">
                            <input type="text" class="form-control validar" ID="Maquina" PlaceHolder="Máquina" name='Maquina'>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <label>Boleta Combustible</label>
                        <div class="input-group">
                            <span>
                                <button data-target="#ModalBoletaCombustible" data-toggle="modal" id="BtnModalBoletaComb" class="btn btn-secondary" title="Buscar Boleta"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="hidden" ID="idBoletaComb" name='idBoletaComb' value="0">
                            <input type="text" class="form-control validar" ID="BoletaComb" PlaceHolder="# Boleta" name='BoletaComb'>
                        </div>
                    </div>

                    <div class='col-md-1'>
                        <label>Cantidad</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="Cantidad" PlaceHolder="Cantidad" name='Cantidad'>
                        </div>
                    </div>

                    <div class='col-md-3'>
                        <label>Responsable</label>
                        <div class="input-group">
                            <input type="hidden" ID="idDespachador" name='idDespachador' value="0">
                            <span>
                                <button data-target="#ModalDespachador" data-toggle="modal" id="BtnModalDespachador" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" class="form-control validar mr-1" ID="Despachador" PlaceHolder="Despachador" name='Despachador' required>
                            <span>
                                <button id="BtnGuardarInsumo" type="submit" class="ui icon yellow button">Guardar</button>
                            </span>
                            <span>
                                <button id="BtnActualizarLineaInsumo" class="d-none ui instagram button">Actualizar</button>
                            </span>
                        </div>
                    </div>
            </section>
        </div>
    </div>

    <!-- TABLA DE MAQUINARIA -->
    <div id="Tbl_insumoComb"></div>
    <!-- FIN TABLA DE MAQUINARIA -->

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
                            <div id="ModalMaq"></div>
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
    <!-- FIN MODAL MAQUINARIA -->

    <!-- MODAL DESPACHADOR -->
    <div id="ModalDespachador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
        <div class="modal-dialog modal-xl" role="document">
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

    <!-- MODAL BOLETA COMBUSTIBLE -->
    <div id="ModalBoletaCombustible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Lista de Ingresos de Combustible</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="ModalBoletaComb"></div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-custom" data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL BOLETA COMBUSTIBLE -->

</div>
<!-- FIN PONER PAGINAS AQUI -->

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>

<script src="js/Combustible_Insumo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#Tbl_insumoComb').load('tables/tblCombustible_insumos.php');
    });
</script>

</body>

</html>