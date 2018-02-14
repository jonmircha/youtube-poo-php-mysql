<?php 
require_once('StatusController.php');

echo '<h1>CRUD con MVC de la Tabla Status</h1>';

$status = new StatusController();

$status_data = $status->read();
var_dump($status_data);

$num_status = count($status_data);

echo "<h2>Número de Status: <mark>$num_status</mark></h2>";

echo '<h2>Tabla de Status</h2>';

echo '<table>
	<tr>
		<th>status_id</th>
		<th>status</th>
	</tr>';
	for ($n = 0; $n < count($status_data); $n++) {
		echo '<tr>
			<td>' . $status_data[$n]['status_id'] . '</td>
			<td>' . $status_data[$n]['status'] . '</td>
		</tr>';
	}
echo '</table>';

echo '<h2>Insertando Status</h2>';
$new_status = array(
	'status_id' => 0,
	'status' => 'Otro Status'
);

//$status->create($new_status);

echo '<h2>Actualizando Status</h2>';
$update_status = array(
	'status_id' => 6,
	'status' => 'Other Status'
);

//$status->update($update_status);

echo '<h2>Eliminando Status</h2>';
//$status->delete(6);