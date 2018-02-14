<?php 
class Cuadrado extends Poligono {
	private $lado;
	
	public function __construct($l) {
		$this->lados = 4;
		$this->lado = $l;
	}

	public function perimetro() {
		return $this->lados * $this->lado;
	}

	public function area() {
		return pow($this->lado, 2);
	}
}