<?php 
class Triangulo extends Poligono {
	private $lado_a;
	private $lado_b;
	private $lado_c;
	private $altura;

	public function __construct($a, $b, $c, $h) {
		$this->lados = 3;
		$this->lado_a = $a;
		$this->lado_b = $b;
		$this->lado_c = $c;
		$this->altura = $h;
	}

	public function perimetro() {
		return $this->lado_a + $this->lado_b + $this->lado_c;
	}

	public function area() {
		return ($this->lado_b * $this->altura) / 2;
	}
}