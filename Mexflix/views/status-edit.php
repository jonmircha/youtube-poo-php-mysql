<?php 
$status_controller = new StatusController();

if( $_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {

	$status = $status_controller->get($_POST['status_id']);

	if( empty($status) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el status_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("status")
				}
			</script>
		';

		printf($template, $_POST['status_id']);
	} else {
		$template_status = '
			<h2 class="p1">Editar Status</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="status_id" value="%s" disabled required>
					<input type="hidden" name="status_id" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="status" placeholder="status" value="%s" required>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="status-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_status,
			$status[0]['status_id'],
			$status[0]['status_id'],
			$status[0]['status']
		);	
	}

} else if( $_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_status = array(
		'status_id' => $_POST['status_id'],
		'status' => $_POST['status']
	);

	$status = $status_controller->set($save_status);

	$template = '
		<div class="container">
			<p class="item  edit">Status <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("status")
			}
		</script>
	';

	printf($template, $_POST['status']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}