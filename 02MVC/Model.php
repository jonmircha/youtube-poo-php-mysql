<?php 
//Clase Abstracta que nos permitirá conectarnos a MySQL
abstract class Model {
	//Atributos
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	//private static $db_name = 'mexflix';
	protected $db_name;
	private static $db_charset = 'utf8';
	private $conn;
	protected $query;
	protected $rows = array();

	//Métodos
	//métodos abstractos para CRUD de clases que hereden
	abstract protected function create();
	abstract protected function read();
	abstract protected function update();
	abstract protected function delete();

	//método privado para conectarse a la base de datos
	private function db_open() {
		//http://php.net/manual/es/class.mysqli.php
		//http://php.net/manual/es/mysqli.construct.php
		$this->conn = new mysqli(
			self::$db_host,
			self::$db_user,
			self::$db_pass,
			$this->db_name
		);

		//http://php.net/manual/es/mysqli.set-charset.php
		$this->conn->set_charset(self::$db_charset);
	}

	//método privado para desconectarse de la base de datos
	private function db_close() {
		//http://php.net/manual/es/mysqli.close.php
		$this->conn->close();
	}

	//establecer un query que afecte datos (INSERT, DELETE o UPDATE)
	protected function set_query() {
		$this->db_open();
		//http://php.net/manual/es/mysqli.query.php
		$this->conn->query($this->query);
		$this->db_close();
	}

	//obtener datos de un query (SELECT)
	protected function get_query() {
		$this->db_open();

		$result = $this->conn->query($this->query);
		//http://php.net/manual/es/mysqli-result.fetch-assoc.php
		//http://php.net/manual/es/mysqli-result.fetch-row.php
		while( $this->rows[] = $result->fetch_assoc() );
		$result->close();

		$this->db_close();

		return array_pop($this->rows);
	}
}