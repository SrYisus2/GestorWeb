<?php
$Exportar = $_GET['exportar'];
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment; filename={$Exportar}.xls");
include_once '../includes/conexion.php';

if (!$conex) {
	echo 'NoConex';
} else if ($Exportar == "IngresoRepuesto") {
	$queryIngresos = "SELECT id, Fecha, Codigo, Descripcion, Cantidad, Medida, Comprobante FROM repuesto ORDER BY Fecha DESC;";
	$result = mysqli_query($conex, $queryIngresos);
?>
	<table>
		<tr>
			<th><label>Id</label></th>
			<th><label>Fecha</label></th>
			<th><label>Codigo</label></th>
			<th><label>Descripción</label></th>
			<th><label>Cantidad</label></th>
			<th><label>Medida</label></th>
			<th><label>Comprobante</label></th>
		</tr>
		<?php
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['Fecha']; ?></td>
				<td><?php echo $row['Codigo']; ?></td>
				<td><?php echo $row['Descripcion']; ?></td>
				<td><?php echo $row['Cantidad']; ?></td>
				<td><?php echo $row['Medida']; ?></td>
				<td><?php echo $row['Comprobante']; ?></td>
			</tr>
		<?php
		}
		?>
	</table>

<?php
} else if ($Exportar == "SalidaRepuestos") {
	$querySalidas = "SELECT rs.id, rs.Fecha, r.Codigo AS codRepuesto, r.Descripcion, rs.Cantidad, m.Codigo AS codMaquina, desp.nombre FROM repuesto_salida rs right JOIN repuesto r ON r.id = rs.idRepuesto INNER JOIN maquinaria m ON m.Id = rs.idMaquina INNER JOIN despachador desp ON desp.id = rs.idResponsable ORDER BY rs.Fecha DESC;";

	$result = mysqli_query($conex, $querySalidas);
?>
	<table>
		<tr>
			<th><label>Id</label></th>
			<th><label>Fecha</label></th>
			<th><label>Codigo de Repuesto</label></th>
			<th><label>Descripción</label></th>
			<th><label>Cantidad</label></th>
			<th><label>Código de Máquina</label></th>
			<th><label>Responsable</label></th>
		</tr>
		<?php
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['Fecha']; ?></td>
				<td><?php echo $row['codRepuesto']; ?></td>
				<td><?php echo $row['Descripcion']; ?></td>
				<td><?php echo $row['Cantidad']; ?></td>
				<td><?php echo $row['codMaquina']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
			</tr>
		<?php
		}
		?>
	</table>

<?php
} else if ($Exportar == "InventarioRepuestos") {
	$queryInventario = "SELECT r.Codigo, r.Descripcion, ri.Cantidad, r.Medida FROM repuesto_inventario AS ri INNER JOIN repuesto AS r on r.Codigo = ri.Codigo GROUP BY r.Codigo;";

	$result = mysqli_query($conex, $queryInventario);
?>
	<table>
		<tr>
			<th><label>Código</label></th>
			<th><label>Descripción</label></th>
			<th><label>Cantidad</label></th>
			<th><label>Medida</label></th>
		</tr>
		<?php
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td><?php echo $row['Codigo']; ?></td>
				<td><?php echo $row['Descripcion']; ?></td>
				<td><?php echo $row['Cantidad']; ?></td>
				<td><?php echo $row['Medida']; ?></td>
			</tr>
		<?php
		}
		?>
	</table>

<?php
} else if ($Exportar == "IngresoCombustible") {
	$queryIngresos =
		"SELECT c.id, c.fecha, c.boleta, c.cantidadlts, c.estado, d.nombre FROM combustible c INNER JOIN despachador d ON d.id = c.idDespachador ORDER BY c.fecha DESC";
	$result = mysqli_query($conex, $queryIngresos);
?>
	<table>
		<tr>
			<th><label>Id</label></th>
			<th><label>Fecha</label></th>
			<th><label>Boleta</label></th>
			<th><label>Cantidad</label></th>
			<th><label>Responsable</label></th>
			<th><label>Estado</label></th>
		</tr>
		<?php
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['boleta']; ?></td>
					<td><?php echo $row['cantidadlts']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $status = ($row['estado']) ? '<span class="badge badge-success">Activo</>' : '<span class="badge badge-danger">Inactivo</>' ?> </td>
				</tr>
		<?php
			}
		}
		?>
	</table>

<?php
} else if ($Exportar == "SalidaCombustibles") {
	$querySalidas = "SELECT ci.id, ci.fecha, ci.BoletaDesp, ci.cantidadlts, m.Codigo, c.boleta, d.nombre FROM combustible_insumo ci INNER JOIN maquinaria m ON m.Id = ci.idMaquina INNER JOIN combustible c ON c.id = ci.idBoletaComb INNER JOIN despachador d ON d.id = ci.idDespachador ORDER BY ci.fecha DESC;";

	$result = mysqli_query($conex, $querySalidas);

?>
	<table>
		<tr>
			<th><label>Id</label></th>
			<th><label>Fecha</label></th>
			<th><label>Boleta Despacho</label></th>
			<th><label>Codigo de Maquina</label></th>
			<th><label>Cantidad</label></th>
			<th><label>Boleta Ingreso</label></th>
			<th><label>Responsable</label></th>
		</tr>
		<?php
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['BoletaDesp']; ?></td>
					<td><?php echo $row['Codigo']; ?></td>
					<td><?php echo $row['cantidadlts']; ?></td>
					<td><?php echo $row['boleta']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
				</tr>
		<?php
			}
		} ?>
	</table>

<?php
} else if ($Exportar == "InventarioCombustibles") {
	$queryInventario = "SELECT c.boleta, (SELECT SUM(cin.cantidadlts) FROM combustible_insumo cin WHERE cin.idBoletaComb = ci.id) AS despacho, ci.saldolts AS saldo FROM combustible_inventario AS ci INNER JOIN combustible AS c on c.id = ci.idCombustible;";

	$result = mysqli_query($conex, $queryInventario);
?>
	<table>
		<tr>
			<th><label>Boleta Ingreso</label></th>
			<th><label>Cantidad Despachada</label></th>
			<th><label>Saldo</label></th>
		</tr>
		<?php
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<tr>
					<td><?php echo $row['boleta']; ?></td>
					<td><?php echo $row['despacho']; ?></td>
					<td><?php echo $row['saldo']; ?></td>
				</tr>
		<?php
			}
		} ?>
	</table>

<?php
}
?>