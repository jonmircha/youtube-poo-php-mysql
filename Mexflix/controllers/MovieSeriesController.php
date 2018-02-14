<?php 
class MovieSeriesController {
	private $model;

	public function __construct() {
		$this->model = new MovieSeriesModel();
	}

	public function set( $ms_data = array() ) {
		return $this->model->set($ms_data);
	}

	public function get( $ms = '' ) {
		return $this->model->get($ms);
	}

	public function del( $ms = '' ) {
		return $this->model->del($ms);
	}

	public function __destruct() {
		unset($this);
	}
}