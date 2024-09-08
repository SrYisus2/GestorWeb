<?php
include_once('../includes/conexion.php');
if (!$conex) {
    echo 'NoConex';
} else {
    $datos = $_REQUEST['datos'];
    $op = $datos[0];
    $repuesta = false;

    switch ($op) {
        case 'Ingresos':
            $table['table'] = '<div class="card shadow-lg mt-2">
                           <div class="card-body">
                               <div class="table-responsiv-lg">
                                   <table id="tblIngresos" class="table table-hover table-sm w-100">
                                       <thead>
                                           <tr>
                                               <th><label>ID</label></th>
                                               <th><label>FECHA</label></th>
                                               <th><label>BOLETA INGRESO</label></th>
                                               <th><label>CANTIDAD</label></th>
                                               <th><label>RESPONSABLE</label></th>
                                               <th><label>ESTADO</label></th>
                                           </tr>
                                       </thead>
                                       <tbody>';

            $queryIngresos = "SELECT c.id, c.fecha, c.boleta, c.cantidadlts, c.estado, d.nombre FROM combustible c INNER JOIN despachador d ON d.id = c.idDespachador ORDER BY c.fecha DESC;";

            $datos = mysqli_query($conex, $queryIngresos);

            if (mysqli_num_rows($datos) > 0) {
                while ($linea = mysqli_fetch_assoc($datos)) {
                    $table['table'] .= "<tr>";
                    $table['table'] .= "<td>" . $linea['id'] . "</td>";
                    $table['table'] .= "<td>" . $linea['fecha'] . "</td>";
                    $table['table'] .= "<td>" . $linea['boleta'] . "</td>";
                    $table['table'] .= "<td>" . $linea['cantidadlts'] . "</td>";
                    $table['table'] .= "<td>" . $linea['nombre'] . "</td>";
                    $table['table'] .= "<td>" . $status = ($row['estado']) ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' . "</td>";
                    $table['table'] .= "</tr>";
                }

                $table['table'] .= "</table>
                   </div>
                   </div>
                   </div>";

                $repuesta = json_encode($table, JSON_UNESCAPED_UNICODE);
            } else {
                $repuesta = 0;
            }
            break;

        case 'Salidas':
            $table['table'] = '<div class="card shadow-lg mt-2">
                                <div class="card-body">
                                    <div class="table-responsiv-lg">
                                        <table id="tblSalidas" class="table table-hover table-sm w-100">
                                            <thead>
                                                <tr>
                                                    <th><label>ID</label></th>
                                                    <th><label>FECHA</label></th>
                                                    <th><label>BOLETA DESPACHO</label></th>
                                                    <th><label>CANTIDAD</label></th>
                                                    <th><label>CODIGO MAQUINA</label></th>
                                                    <th><label>BOLETA COMBUSTIBLE</label></th>
                                                    <th><label>RESPONSABLE</label></th>
                                                </tr>
                                            </thead>
                                            <tbody>';

            $querySalidas = "SELECT ci.id, ci.fecha, ci.BoletaDesp, ci.cantidadlts, m.Codigo, c.boleta, d.nombre FROM combustible_insumo ci INNER JOIN maquinaria m ON m.Id = ci.idMaquina INNER JOIN combustible c ON c.id = ci.idBoletaComb INNER JOIN despachador d ON d.id = ci.idDespachador ORDER BY ci.fecha DESC;";

            $datos = mysqli_query($conex, $querySalidas);

            if (mysqli_num_rows($datos) > 0) {
                while ($linea = mysqli_fetch_assoc($datos)) {
                    $table['table'] .= "<tr>";
                    $table['table'] .= "<td>" . $linea['id'] . "</td>";
                    $table['table'] .= "<td>" . $linea['fecha'] . "</td>";
                    $table['table'] .= "<td>" . $linea['BoletaDesp'] . "</td>";
                    $table['table'] .= "<td>" . $linea['cantidadlts'] . "</td>";
                    $table['table'] .= "<td>" . $linea['Codigo'] . "</td>";
                    $table['table'] .= "<td>" . $linea['boleta'] . "</td>";
                    $table['table'] .= "<td>" . $linea['nombre'] . "</td>";
                    $table['table'] .= "</tr>";
                }

                $table['table'] .= "</table>
                        </div>
                        </div>
                        </div>";

                $repuesta = json_encode($table, JSON_UNESCAPED_UNICODE);
            } else {
                $repuesta = 0;
            }
            break;
    }

    mysqli_close($conex);
    echo $repuesta;
}
