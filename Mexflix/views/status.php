<?php 
print('<h2 class="p1">GESTIÓN DE STATUS</h2>');

$status_controller = new StatusController();
$status = $status_controller->get();

if( empty($status) ) {
	print( '
		<div class="container">
			<p class="item  error">No hay Status</p>
		</div>
	');
} else {
	$template_status = '
	<div class="item">
		<table>
			<tr>
				<th>Id</th>
				<th>Status</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="status-add">
						<input class="button  add" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n=0; $n < count($status); $n++) { 
		$template_status .= '
			<tr>
				<td>' . $status[$n]['status_id'] . '</td>
				<td>' . $status[$n]['status'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="status-edit">
						<input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
						<input class="button  edit" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="status-delete">
						<input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
						<input class="button  delete" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		'; 
	}

	$template_status .= '
		</table>
	</div>
	';

	print($template_status);
}