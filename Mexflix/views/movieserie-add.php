<?php 
if( $_POST['r'] == 'movieserie-add' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {

	$status_controller = new StatusController();
	$status = $status_controller->get();
	$status_select = '';

	for ($n=0; $n < count($status); $n++) { 
		$status_select .= '<option value="' . $status[$n]['status_id'] . '">' . $status[$n]['status'] . '</option>';
	}


	printf('
		<h2 class="p1">Agregar MovieSerie</h2>
		<form method="POST" class="item">
			<div class="p_25">
				<input type="text" name="imdb_id" placeholder="imdb_id" required>
			</div>
			<div class="p_25">
				<input type="text" name="title" placeholder="título" required>
			</div>
			<div class="p_25">
				<textarea name="plot" cols="22" rows="10" placeholder="descripción"></textarea>
			</div>
			<div class="p_25">
				<input type="text" name="author" placeholder="autor">
			</div>
			<div class="p_25">
				<input type="text" name="actors" placeholder="actores">
			</div>
			<div class="p_25">
				<input type="text" name="country" placeholder="país">
			</div>
			<div class="p_25">
				<input type="text" name="premiere" placeholder="estreno" required>
			</div>
			<div class="p_25">
				<input type="url" name="poster" placeholder="poster">
			</div>
			<div class="p_25">
				<input type="url" name="trailer" placeholder="trailer">
			</div>
			<div class="p_25">
				<input type="number" name="rating" placeholder="rating" required>
			</div>
			<div class="p_25">
				<input type="text" name="genres" placeholder="géneros" required>
			</div>
			<div class="p_25">
				<select name="status" placeholder="status" required>
					<option value="">status</option>
					%s
				</select>
			</div>
			<div class="p_25">
				<input type="radio" name="category" id="movie" value="Movie" required><label for="movie">Movie</label>
				<input type="radio" name="category" id="serie" value="Serie" required><label for="serie">Serie</label>
			</div>
			<div class="p_25">
				<input  class="button  add" type="submit" value="Agregar">
				<input type="hidden" name="r" value="movieserie-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	', $status_select);	

} else if( $_POST['r'] == 'movieserie-add' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {
	$ms_controller = new MovieSeriesController();

	$new_ms = array(
		'imdb_id' =>  $_POST['imdb_id'],
		'title' =>  $_POST['title'], 
		'plot' =>  $_POST['plot'], 
		'author' =>  $_POST['author'],
		'actors' =>  $_POST['actors'],
		'country' =>  $_POST['country'],
		'premiere' =>  $_POST['premiere'],
		'poster' =>  $_POST['poster'],
		'trailer' =>  $_POST['trailer'],
		'rating' =>  $_POST['rating'],
		'genres' =>  $_POST['genres'],
		'status' =>  $_POST['status'],
		'category' =>  $_POST['category']
	);

	$ms = $ms_controller->set($new_ms);

	$template = '
		<div class="container">
			<p class="item  add">MovieSerie <b>%s</b> salvada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("movieseries")
			}
		</script>
	';

	printf($template, $_POST['title']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}