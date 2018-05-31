<?php

class Validate {
	public $file_validate;//сохраним здесь языковый файл валидации полей
	
public function __construct ($imgfile){
	
	$this->file_validate=$imgfile;
}

//проверка на пустоту
public function required($param,$param2){
if(empty($param) || $param=''){
	  $_SESSION['message'] .= "<div class='alert-danger'>".$param2.' '.$this->file_validate['required']."</div>";
	  return true;
	}
 return false;
	
 }
 
//проверка на количество символов
public function max_number($param,$param2){
	    if(mb_strlen($param) < 6){
		       $_SESSION['message'] .= "<div class='alert-danger'>".$param2.' '.$this->file_validate['max']." 6.</div>";
			   return true;
	     }
	return false;
}

//проверка на латинские символы
public function latin_simvol($param,$param2,$reqv){
	preg_match("$reqv", $param,$arr);
	 if(empty($arr[0])){
			      $_SESSION['message'] .= "<div class='alert-danger'>".$param2.' '.$this->file_validate['latin'].".</div>";
				  return true;
	         }
	return false;
}

//проверка на соответствие синтаксису email
public function email($param,$param2){
	$param = strtolower($param);

	preg_match("/^([a-z0-9_.-]{1,20})@([a-z0-9.-]{1,20}).([a-z]{2,4})/is", $param,$arr);
	
	 if(empty($arr[0])){
		 
			      $_SESSION['message'] .= "<div class='alert-danger'>".$param2.' '.$this->file_validate['email'].".</div>";
				  return true;
	         }
	 return false;
	
}

//проверка на совпадение паролей
public function compare($param,$param2){
	if($param != $param2){
		$_SESSION['message'] .= "<div class='alert-danger'>".$this->file_validate['repass'].".</div>";
		return true;
		
   }
   return false;
}













}

?>