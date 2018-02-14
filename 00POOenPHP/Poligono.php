<?php 
abstract class Poligono {
	protected $lados;

	abstract protected function perimetro();

	abstract protected function area();

	public function lados() {
		return 'Un <mark>' . get_called_class() . '</mark> tiene <mark>' . $this->lados . '</mark> lados';
	}
}