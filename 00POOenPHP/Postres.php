<?php 
interface Ingredientes {
	public function establecer_ingredientes($lista);
	public function obtener_ingredientes();
}

interface Receta {
	public function establecer_receta($pasos);
	public function obtener_receta();
}

class Postre implements Ingredientes, Receta {
	private $ingredientes;
	private $receta;

	public function establecer_ingredientes($lista) {
		$this->ingredientes = explode(',', $lista);
	}

	public function obtener_ingredientes() {
		$num_ingredientes = count($this->ingredientes);

		$html = '<ul>';
		for ($i=0; $i < $num_ingredientes; $i++) { 
			$html .= '<li>' . $this->ingredientes[$i] . '</li>';
		}
		$html .= '</ul>';

		return print($html);
	}

	public function establecer_receta($pasos) {
		$this->receta = explode('|', $pasos);
	}

	public function obtener_receta() {
		$num_pasos = count($this->receta);

		$html = '<ol>';
		for ($i=0; $i < $num_pasos; $i++) { 
			$html .= '<li>' . $this->receta[$i] . '</li>';
		}
		$html .= '</ol>';

		return print($html);
	}
}

echo '<h1>Postres</h1>';


echo '<h2>Hot Cakes</h2>';
$hot_cakes = new Postre();
echo '<h3>Ingredientes:</h3>';
$hot_cakes->establecer_ingredientes('
	1 taza de harina para hot cakes,
	1 huevo,
	1/3 taza de leche,
	10 gotas de vainilla,
	3 cucharadas de mantequilla
');
$hot_cakes->obtener_ingredientes();
echo '<h3>Receta:</h3>';
$hot_cakes->establecer_receta('
	Mezclar todos los ingredientes excepto la mantequilla en un recipiente hasta tener una masa espesa y uniforme|
	Calentar 1 cucharada de mantequilla a fuego lento en un sartén|
	Cuando la mantequilla se derrita, vertir la mezcla hasta formar un círculo|
	Dejar calentar la mezcla hasta que comiencen a salir burbújas|
	Cuando la consistencia se vea esponjosa voltear|
	Dejar cocinar el segundo lado por 3 minutos|
	Repetir el paso 2 al 6 hasta que se acabe la mezcla
');
$hot_cakes->obtener_receta();


echo '<h2>Pay de Limón Casero</h2>';
$pay_limon = new Postre();
echo '<h3>Ingredientes:</h3>';
$pay_limon->establecer_ingredientes('
	1 lata leche descremada,
	1 lata de lechera,
	7 limones grandes,
	3 paquetes de galletas maria
');
$pay_limon->obtener_ingredientes();
echo '<h3>Receta:</h3>';
$pay_limon->establecer_receta('
	Obtener el jugo de los 7 limones|
	En un recipiente a parte vaciar la leche descremada y la lechera, mezclar|
	Agregar el jugo de los 7 limones y mezclar|
	En otro recipiente a parte colocar una base de galletas hasta formar una capa que recubre el mismo|
	Una vez tenida nuestra base de galletas verter la mezcla hasta que se cubra la capa de galleta|
	Repetir el paso 4 y 5 hasta que se acaben las capas de galletas cubiertas de mezcla|
	Refrigerar por 2 horas
');
$pay_limon->obtener_receta();