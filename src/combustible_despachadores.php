<!DOCTYPE html>
<html lang="en">

<head>
    <title>Despachadores</title>
    <?php include_once("includes/head.php"); ?>
</head>

<?php include_once("includes/bodyHead.php"); ?>

<div class="container-fluid">
    <div class="card shadow mb-1">
        <a href="#CardRegistroCombustible" class="d-block card-header py-3 collapsed text-black-50" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="CardRegistroCombustible">
            <h6 class="m-0 font-weight-bold">Registro de Despachadores</h6>
        </a>
        <div class="collapse show" id="CardRegistroCombustible">
            <section class='pt-2 card card-header'>
                <input type="hidden" ID="id" name='id' value="0">
                <div class='row'>
                    <div class='col-md-4'>
                        <label>Identificación</label>
                        <div class="form-group">
                            <input type="text" class="form-control validar" ID="Identificacion" PlaceHolder="Identificación" name='Identificacion' required>
                        </div>
                    </div>

                    <div class='col-md-4'>
                        <label>Nombre Completo</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="Nombre" PlaceHolder="Nombre completo" name='Nombre' required>
                        </div>
                    </div>

                    <div class='col-md-4'>
                        <label>Número de teléfono</label>
                        <div class="input-group">
                            <input type="text" class="form-control validar" ID="Telefono" PlaceHolder="Teléfono" name='Telefono' required>
                            <span>
                                <button id="BtnGuardarDespachador" type="submit" class="ui icon yellow button">Guardar</button>
                            </span>
                            <span>
                                <button id="BtnActualizarDespachador" class="d-none ui instagram button">Actualizar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div id="tblDespachador"></div>

</div>

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>
<script src="js/Combustible_Despachadores.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tblDespachador').load('tables/tblDespachadores.php');
    });
</script>

</body>

</html>