<?php 
abstract class Model {
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	private static $db_name = 'mexflix';
	private static $db_charset = 'utf8';
	private $conn;
	protected $query;
	protected $rows = array();

	abstract protected function set();
	abstract protected function get();
	abstract protected function del();

	private function db_open() {
		$this->conn = new mysqli(
			self::$db_host,
			self::$db_user,
			self::$db_pass,
			self::$db_name
		);

		$this->conn->set_charset(self::$db_charset);
	}

	private function db_close() {
		$this->conn->close();
	}

	protected function set_query() {
		$this->db_open();
		$this->conn->query($this->query);
		$this->db_close();
	}

	protected function get_query() {
		$this->db_open();

		$result = $this->conn->query($this->query);
		while( $this->rows[] = $result->fetch_assoc() );
		$result->close();

		$this->db_close();

		return array_pop($this->rows);
	}
}