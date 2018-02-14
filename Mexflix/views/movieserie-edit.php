<?php 
$ms_controller = new MovieSeriesController();

if( $_POST['r'] == 'movieserie-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {

	$ms = $ms_controller->get($_POST['imdb_id']);

	if( empty($ms) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la MovieSerie <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("movieseries")
				}
			</script>
		';

		printf($template, $_POST['imdb_id']);
	} else {
		$category_movie = ($ms[0]['category'] == 'Movie') ? 'checked' : '';
		$category_serie = ($ms[0]['category'] == 'Serie') ? 'checked' : '';

		$status_controller = new StatusController();
		$status = $status_controller->get();
		$status_select = '';

		for ($n=0; $n < count($status); $n++) { 
			$selected = ($ms[0]['status'] == $status[$n]['status']) ? 'selected' : '';
			$status_select .= '<option value="' . $status[$n]['status_id'] . '"' . $selected . '>' . $status[$n]['status'] . '</option>';
		}

		$template_ms = '
			<h2 class="p1">Editar MovieSerie</h2>
			<form method="POST" class="item">
				<div class="p_25">
					<input type="text" placeholder="imdb_id" value="%s" disabled required>
					<input type="hidden" name="imdb_id" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="title" placeholder="título" value="%s" required>
				</div>
				<div class="p_25">
					<textarea name="plot" cols="22" rows="10" placeholder="descripción">%s</textarea>
				</div>
				<div class="p_25">
					<input type="text" name="author" placeholder="autor" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="actors" placeholder="actores" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="country" placeholder="país" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="premiere" placeholder="estreno" value="%s" required>
				</div>
				<div class="p_25">
					<input type="url" name="poster" placeholder="poster" value="%s">
				</div>
				<div class="p_25">
					<input type="url" name="trailer" placeholder="trailer" value="%s">
				</div>
				<div class="p_25">
					<input type="number" name="rating" placeholder="rating" value="%s" required>
				</div>
				<div class="p_25">
					<input type="text" name="genres" placeholder="géneros" value="%s" required>
				</div>
				<div class="p_25">
					<select name="status" placeholder="status" required>
						<option value="">status</option>
						%s
					</select>
				</div>
				<div class="p_25">
					<input type="radio" name="category" id="movie" value="Movie" %s required><label for="movie">Movie</label>
					<input type="radio" name="category" id="serie" value="Serie" %s required><label for="serie">Serie</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="movieserie-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_ms,
			$ms[0]['imdb_id'],
			$ms[0]['imdb_id'],
			$ms[0]['title'],
			$ms[0]['plot'],
			$ms[0]['author'],
			$ms[0]['actors'],
			$ms[0]['country'],
			$ms[0]['premiere'],
			$ms[0]['poster'],
			$ms[0]['trailer'],
			$ms[0]['rating'],
			$ms[0]['genres'],
			$status_select,
			$category_movie,
			$category_serie
		);	
	}

} else if( $_POST['r'] == 'movieserie-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_ms = array(
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

	$ms = $ms_controller->set($save_ms);

	$template = '
		<div class="container">
			<p class="item  edit">MovieSerie <b>%s</b> salvada</p>
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