<?php
class Admin {
	
	static $instance;
	public $db_connect;
	
	
	
	static function instance() {
		if(self::$instance instanceof self) {
			return self::$instance;
		}
		return self::$instance = new self;
	}
	
	private function __construct() {
	
		
		try {
			$this->db_connect = Database::connect();//связь с базой, находиться - model/Database.php
		}
		catch(Exception $e) {
			exit();
		}
	}
	

	
	
	
		public function select($sql){//запрос типа select
		$db=$this->db_connect->base_mysqli();//связывается в конструкторе с файлом Database.php и тянет метод base_mysqli который возвращает соеденение

        $res=$db->query($sql);//отправяем запрос
		if($res){
			for($i = 0; $i < $res->num_rows; $i++) {
			$row[] = $res->fetch_assoc();
			return $row;
		}
		}else
		{
			return false;
		}
		}
	
	
	
	
	
	
	
	
	
	
	
	
	}

?>