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
                                               <th><label>CODIGO REPUESTO</label></th>
                                               <th><label>DESCRIPCION</label></th>
                                               <th><label>CANTIDAD</label></th>
                                               <th><label>MEDIDA</label></th>
                                               <th><label>COMPROBANTE</label></th>
                                           </tr>
                                       </thead>
                                       <tbody>';

               $queryIngresos = "SELECT id, Fecha, Codigo, Descripcion, Cantidad, Medida, Comprobante FROM repuesto WHERE Fecha BETWEEN '" . $datos[1] . "' AND '" . $datos[2] . "' ORDER BY Fecha DESC;";

               $datos = mysqli_query($conex, $queryIngresos);

               if (mysqli_num_rows($datos) > 0) {
                    while ($linea = mysqli_fetch_assoc($datos)) {
                         $table['table'] .= "<tr>";
                         $table['table'] .= "<td>" . $linea['id'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Fecha'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Codigo'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Descripcion'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Cantidad'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Medida'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Comprobante'] . "</td>";
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
                                                    <th><label>CODIGO REPUESTO</label></th>
                                                    <th><label>DESCRIPCION</label></th>
                                                    <th><label>CANTIDAD</label></th>
                                                    <th><label>CODIGO MAQUINA</label></th>
                                                    <th><label>RESPONSABLE</label></th>
                                                </tr>
                                            </thead>
                                            <tbody>';

               $querySalidas = "SELECT rs.id, rs.Fecha, r.Codigo AS codRepuesto, r.Descripcion, rs.Cantidad, m.Codigo AS codMaquina, desp.nombre FROM repuesto_salida rs right JOIN repuesto r ON r.id = rs.idRepuesto INNER JOIN maquinaria m ON m.Id = rs.idMaquina INNER JOIN despachador desp ON desp.id = rs.idResponsable WHERE rs.Fecha BETWEEN '" . $datos[1] . "' AND '" . $datos[2] . "' ORDER BY rs.Fecha DESC;";

               $datos = mysqli_query($conex, $querySalidas);

               if (mysqli_num_rows($datos) > 0) {
                    while ($linea = mysqli_fetch_assoc($datos)) {
                         $table['table'] .= "<tr>";
                         $table['table'] .= "<td>" . $linea['id'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Fecha'] . "</td>";
                         $table['table'] .= "<td>" . $linea['codRepuesto'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Descripcion'] . "</td>";
                         $table['table'] .= "<td>" . $linea['Cantidad'] . "</td>";
                         $table['table'] .= "<td>" . $linea['codMaquina'] . "</td>";
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
