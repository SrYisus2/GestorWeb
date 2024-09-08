<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ver Solicitudes de Repuestos</title>
    <?php include_once("includes/head.php"); ?>
</head>

<?php include_once("includes/bodyHead.php"); ?>

<div class="container-fluid">
    <!-- TABLA DE MAQUINARIA -->
    <div id="TblVerSolicitudes"></div>
    <!-- FIN TABLA DE MAQUINARIA -->

    <div id="Modal" tabindex="-100" role="dialog" aria-labelledby="myModalLabel" class="modal fade">
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

<?php
include_once("includes/bodyFooter.php");
include_once("includes/footer.php");
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#TblVerSolicitudes').load('tables/tblVerSolicitudesRepuestos.php');
    });
</script>
<script src="js/Repuestos_VerSolicitudes.js" type="text/javascript"></script>

</body>

</html>