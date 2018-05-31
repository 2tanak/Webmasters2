<?php
defined('DOSTUP') or exit('Access denied');

class Register_Controller extends Controller {
	
public $db;
	


public function db_connect(){
	$this->db = Register::instance();//соеденение с моделью регистрации, 
}


public function unique($login=false,$email=false){//проверка полей email и login на уникальность

  $select=$this->db->select("SELECT * FROM user WHERE login = '{$login}' OR email = '{$email}'");
	if($select){
	    if($login){
		 	if(!empty($select[0]['login']) && $select[0]['login'] == $login){
				   $_SESSION['message'] .= "<div class='alert-danger'>не уникальное значение ".$login."</div>";//отправляем при отправки формы
				    
				   }
	}
	if($email){
		if(!empty($select[0]['email']) && $select[0]['email'] == $email){
				$_SESSION['message'] .= "<div class='alert-danger'>не уникальное значение ".$email."</div>";}//отправляем при отправки формы
				
	       }
		 
		}
  return $select;//отдаем при ajax запросе
}

	
	

	protected function output($param) {
    $this->db_connect();//подключаемся к модели регистр, чтобы связаться с базой, модель находиться в папке model
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')  {//если запрс пришел методом ajax
	   $id=trim(strip_tags($_POST[id]));
	  $value=trim(strip_tags($_POST[value]));
	  if($id == 'login'){
		  $login = $value;
		  $email = false;
	  }
	    if($id == 'email'){
		  $email = $value;
		  $login = false;
	  }
	
	  $select=$this->unique($login,$email);
	   unset($_SESSION['message']);//она для ajax не нужна, это нужно когда отправляем данные с формы постом
	  if($select[0]['id']){
		  echo 'ok';//будь то email или логин, значит такое значение есть и оно не уникально, поэтому уведомляем об этом обработчик
	  }else{
		  echo 'no';//если значение уникально то уведомляем об этом обработчик
	  }
		  
	  
	  exit;

	}
	
	
	
	
//получаем данные регистрации формы от клиента
if(!empty($_POST)){
	//echo "<pre>";print_r($_FILES['upload']);echo "</pre>";exit();
	
	
		if(!empty($_POST['xss'])){//проверка пришел ли токен защиты от xss атак
				 $xss = trim(strip_tags($_POST['xss']));
				 if($xss != $_SESSION['xss']){exit();}
				}else{
					 exit();
				}
	
	//print_r($_FILES['upload']['error']);exit();
	if(empty($_FILES['upload']['error'])){//принимаем от клиента картинку
	$image = new Image($_FILES);//класс image находиться в lib/image.php
	$image->check_error();//проверяет есть ли ошибка в переменной $_FILES['upload']['error'], проверяет на размер, при ошибке делает перенаправление
	$type=$image->check_format();//проверка на допустимый формат изображения jpg, png, gif, при ошибке делает перенаправление с сообщением об ошибке
	$image->tmp_save();//временное сохранение изображание в папку images/, при ошибке делает перенаправление с сообщением об ошибке
	$name_img  = $image->img_resize($type);//обработка и сохранение картинки в папку, возвращает название картинки под которым ее сохранили
	}
	
	$flag=false;
	$login = strtolower(trim(strip_tags($_POST['login'])));
	$email = trim(strip_tags($_POST['email']));
	$pass = trim(strip_tags($_POST['pass']));
	$repass = trim(strip_tags($_POST['repass']));
	
	//языковый файл находиться в папке lang, подключаеться в точке входа корень/index.php
	global $validater;//подключение языкового файла с валидацией полей
    global $lang_message;//подключаем языковый файл с с сообщением об ошибках
    global $label;//подключаем языковый файл с метками полей
	
	/*---------начали валидацию---------*/
	$validate = new Validate($validater);
	$_SESSION['message']='';//объявляем переменную
	
	//валидация логина;
	$validate->required($login, $label['login']);//валидация логина на пустоту
	$validate->max_number($login, $label['login']);//проверка логина на количество символов
	$validate->latin_simvol($login, $label['login'],'/^[qwertyuiopasdfghjklzxcvbnm][\w\s]*/is');//проверка логина на латинские символы
	
	  //валидация email;	
	$validate->required($email, 'email');//валидация email на пустоту
	$validate->email($email,'email');//валидация email на email
	
	// проверка пароля
    $validate->required($pass, $label['pass']);//валидация пароля на пустоту
    $validate->compare($pass, $repass);// сравнение паролей
	$this->unique($login,$email);/*---------проверка на уникальность полей---------*/
	/*---------закончили валидацию---------*/
    
    
	
 
		 
			 
			 
			 
			 
			 
if(!empty($_SESSION['message'])){//если есть ошибки
	        $_SESSION['povtor']['email']=$_POST['email'];//запоминаем,чтобы пользователь повторно не вводил и исправил, если это нужно
	        $_SESSION['povtor']['login']=$_POST['login'];//запоминаем,чтобы пользователь повторно не вводил и исправил, если это нужно
			header("Location:".$_SERVER[HTTP_REFERER]);exit();
}

//если нет ошибок
$pass = md5($pass);
$dd=$this->db->insert("INSERT INTO user (password, login, email, img) VALUES ('{$pass}','{$login}','{$email}','{$name_img}')");
		if($dd === true){
			  $_SESSION['message'] = "<div class='alert-success'>".$lang_message['success']."</div>";
			   unset($_SESSION['povtor']);
		 }else{
			  $_SESSION['message'] = "<div class='alert-danger'>".$lang_message['error']."</div>";
		 }
		 //print_r($db);exit();
	    
	    
	      header("Location:".$_SERVER[HTTP_REFERER]);exit();
	
}//закончился метод пост

			

		
		
		$content = $this->view(TEMPLATE_TEST.'register',array());
		
		$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content' => $content,
											
										));
		
		
		
		unset($_SESSION['message']);
		return $this->page;
		
	}
}
?>