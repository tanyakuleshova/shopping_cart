<?php

class DB{

	/**
	 * @var null
	 */
	private $connection = null;

	/**
	 * DB constructor.
	 *
	 * @param $host
	 * @param $login
	 * @param $psw
	 * @param $db_name
	 */
	public function __construct($host, $login, $psw, $db_name) {
		$this->connection = mysqli_connect($host, $login, $psw, $db_name);
		// Set collation
		mysqli_query($this->connection, 'set names utf8');
	}
	public function connect_error(){
		if ($this->connection) {
			echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
			echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		  }
	}

	/**
	 * @param $sql
	 *
	 * @return array|bool|mysqli_result
	 */
	public function query($sql){
		// Get results
		$result = mysqli_query($this->connection, $sql);
		// If bool
		if(is_bool($result)){
			return $result;
		}
		// If we get rows
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		return $rows;
	}

	/**
	 * @param $string
	 *
	 * @return string
	 */
	public function escape($string){
		return mysqli_escape_string($this->connection, $string);
	}
	public function close(){
		return mysqli_close($this->connection);
	}

	public function check($value = "") {
		$value = trim($value);
		$value = strtolower($value);
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		return $value;
	  }

}