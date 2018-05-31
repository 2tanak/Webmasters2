<?php
class Database {
	
	static $instance;
	
	public $mysqli;
	
	static function connect() {
		if(self::$instance instanceof self) {
			return self::$instance;
		}
		return self::$instance = new self;
	}
	
	public function __construct() {
	
	}
	
	
	
		public function base_mysqli(){
		
		$db = new mysqli(HOST,USER,PASSWORD,DB_NAME);
		$db->query("SET NAMES 'UTF8'");
		if($db->connect_error) {
			throw new Exception("Ошибка соединения : ".$db->connect_errno."|".iconv("CP1251","UTF-8",$db->connect_error));
		}
		
		
		return $db;
		
	}
	
	}
?>