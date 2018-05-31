<?php
class Login {
	
	static $instance;
	
	public $ins_driver;
	
	
	static function instance() {
		if(self::$instance instanceof self) {
			return self::$instance;
		}
		return self::$instance = new self;
	}
	
	private function __construct() {
		
		try {
			$this->db_connect = Database::connect();
		}
		catch(Exception $e) {
			exit();
		}
	}
	
	public function select($sql){
		$db=$this->db_connect->base_mysqli();
        $res=$db->query($sql);
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