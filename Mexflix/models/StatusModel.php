<?php 
class StatusModel extends Model {
	public function set( $status_data = array() ) {
		foreach ($status_data as $key => $value) {
			$$key = $value;
		}

		$this->query = "REPLACE INTO status (status_id, status) VALUES ($status_id, '$status')";
		$this->set_query();
	}

	public function get( $status_id = '' ) {
		$this->query = ($status_id != '')
			?"SELECT * FROM status WHERE status_id = $status_id"
			:"SELECT * FROM status";
		
		$this->get_query();

		$num_rows = count($this->rows);

		$data = array();

		foreach ($this->rows as $key => $value) {
			array_push($data, $value);
		}

		return $data;
	}

	public function del( $status_id = '' ) {
		$this->query = "DELETE FROM status WHERE status_id = $status_id";
		$this->set_query();
	}

	public function __destruct() {
		unset($this);
	}
}