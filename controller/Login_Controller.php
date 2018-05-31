<?php
class Login_Controller extends Controller {
private $cyfer = MCRYPT_BLOWFISH;
private $mode = MCRYPT_MODE_CFB;
static $cookie_name = 'TESTSITE';
	
	
	
		public function set_sookie($result){
			$id = $result[0]['id'];
			$login = $result[0]['login'];
			
			$arrs=array('id' => $id, 'login' => $login);
		
			$serialize=serialize($arrs);
	        $arr = array($serialize,time(),'1');
			$str = implode('|',$arr);
			//используем алгоритм шифрования mcoript
			$blowfish = MCRYPT_BLOWFISH;
            $mode = MCRYPT_MODE_CFB;
            $td = mcrypt_module_open($blowfish,'',$mode,'');	
		    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td),MCRYPT_RAND);
		    mcrypt_generic_init($td,KEY,$iv);
		    $crypt_text = mcrypt_generic($td,$str);
		    mcrypt_generic_deinit($td);
		    $cookie_text=$iv.$crypt_text;
		    setcookie(self::$cookie_name,$cookie_text,0,DOMEN);
		
		
	}
	

	protected function input($param = array()) {
	
}
	
	protected function output($param) {
		
			if(isset($param['logout'])) {
		         setcookie(self::$cookie_name,"",(time()-3600),DOMEN);
                 unset($_SESSION['user']);
			     $_SESSION['message'] .= "<div class='alert-success'>Вы успешно вышли из системы ".$login."</div>";
			     header("Location:".$_SERVER[HTTP_REFERER]);exit();
		     }
		
		
		
			if($_POST){//получили логин и пароль с формы авторизации
			//print_r($_POST);
			      if(!empty($_POST['xss'])){//проверка пришел ли токен защиты от xss атак
				       $xss = trim(strip_tags($_POST['xss']));
				       if($xss != $_SESSION['xss']){exit();}
				  }else{
					 exit();
				  }
				global $validater;//подключение языкового файла с валидацией полей
				global $lang_message;//подключаем языковый файл с с сообщением об ошибках
                global $label;//подключаем языковый файл с метками полей
				
				$validate = new Validate($validater);
	            $_SESSION['message']='';//объявляем переменную
				
				
				
				$login = trim(strip_tags($_POST['login']));
				$password = trim(strip_tags($_POST['pas']));
				$validate->required($login, $label['login']);//валидация логина на пустоту
				$validate->max_number($login, $label['login']);//проверка логина на количество символов
	            $validate->latin_simvol($login, $label['login'],'/^[qwertyuiopasdfghjklzxcvbnm][\w\s]*/is');//проверка логина на латинские символы
				// проверка пароля
                $validate->required($password , $label['pass']);//валидация пароля на пустоту
               
	          
				//если есть ошибки то делаем перенаправления с выходом из скрипта
				if($_SESSION['message'] !=''){header("Location:".$_SERVER[HTTP_REFERER]);exit();}
				$db = Login::instance();//связь с моделью логина
				$pass = md5($password);
				
		        $result=$db->select("SELECT * FROM user WHERE login = '{$login}' AND password = '{$pass}'");
				if($result){
				//если есть такая пара логин пароль то записываем в куки данные пользователя
					  $this->set_sookie($result);
					  header("Location:".'/admin');exit();
				}else{
					  $_SESSION['message'] = "<div class='alert-danger'>Неверный логин или пароль</div>";
					  header("Location:".'/login');exit();
					  exit();
				}
			}
		
		
		$content = $this->view(TEMPLATE_TEST.'login',array());
		
		$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content' => $content,
											
										));
		
		
		unset($_SESSION['message']);
		
		return $this->page;
		
		
		
	}
}
?>