<?php 
class Rectangulo extends Poligono {
	private $base;
	private $altura;
	
	public function __construct($b, $h) {
		$this->lados = 4;
		$this->base = $b;
		$this->altura = $h;
	}

	public function perimetro() {
		return ($this->base + $this->altura) * 2;
	}

	public function area() {
		return $this->base * $this->altura;
	}
}