<?php 
$users_controller = new UsersController();

if( $_POST['r'] == 'user-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {

	$user = $users_controller->get($_POST['user']);

	if( empty($user) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el usuario <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("usuarios")
				}
			</script>
		';

		printf($template, $_POST['user']);
	} else {
		$role_admin = ($user[0]['role'] == 'Admin') ? 'checked' : '';
		$role_user = ($user[0]['role'] == 'User') ? 'checked' : '';

		$template_user = '
			<h2 class="p1">Editar Usuario</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="usuario" value="%s" disabled required>
					<input type="hidden" name="user" value="%s">
				</div>
				<div class="p_25">
					<input type="email" name="email" placeholder="email" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="name" placeholder="nombre" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="birthday" placeholder="cumpleaños" value="%s" required>
				</div>
				<div class="p_25">
					<input type="password" name="pass" placeholder="password" value="" required>
				</div>
				<div class="p_25">
					<input type="radio" name="role" id="admin" value="Admin" %s required><label for="admin">Administrador</label>
					<input type="radio" name="role" id="noadmin" value="User" %s required><label for="noadmin">Usuario</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="user-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_user,
			$user[0]['user'],
			$user[0]['user'],
			$user[0]['email'],
			$user[0]['name'],
			$user[0]['birthday'],
			//$user[0]['pass'],
			$role_admin,
			$role_user
		);	
	}

} else if( $_POST['r'] == 'user-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_user = array(
		'user' =>  $_POST['user'], 
		'email' =>  $_POST['email'], 
		'name' =>  $_POST['name'], 
		'birthday' =>  $_POST['birthday'], 
		'pass' =>  $_POST['pass'], 
		'role' =>  $_POST['role']
	);

	$user = $users_controller->set($save_user);

	$template = '
		<div class="container">
			<p class="item  edit">Usuario <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("usuarios")
			}
		</script>
	';

	printf($template, $_POST['user']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}