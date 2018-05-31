<?php
defined('DOSTUP') or exit('Access denied');
class Admin_Controller extends Controller{
static $cookie_name = 'TESTSITE';	

	
	
private function check_login() {//проверяем есть ли кука с записью о том что пользователь был автаризирован
			if(array_key_exists(self::$cookie_name,$_COOKIE)) {
			$str=$_COOKIE[self::$cookie_name];
			if(empty($_SESSION['user'])){
				
			//начинаем расшифровку кук	
				$blowfish = MCRYPT_BLOWFISH;
                $mode = MCRYPT_MODE_CFB;
                $td = mcrypt_module_open($blowfish,'',$mode,'');	
                $size = mcrypt_enc_get_iv_size($td);
                $iv = substr($str,0,$size);
			    $crypt_text = substr($str,$size);
			    mcrypt_generic_init($td,KEY,$iv);
			    $text = mdecrypt_generic($td,$crypt_text);
			    mcrypt_generic_deinit($td);
			    list($user,$time,$version) = explode('|',$text);
			    $user = unserialize($user);
				
				$_SESSION['user']=$user['login'];
				
			}
			return true;
			}
			else {
				 return false;
			}}
	
	
	
protected function output($param=array()) {
	
	
	
		//вызываем проверку кук, если нет то перебрасываем на логин
		if($this->check_login()){
			$prefix=$_SESSION['lang'];
			     $db = Admin::instance();//подключаемся к модели admin
				   $result=$db->select("SELECT * FROM content_$prefix");
			    
			     
			
			
		}else{
			header("Location:".'/login');exit();//если куки не записаны то отправляем на логин
		}
						
						
						
						
						
						
						
						
												
			$content = $this->view(TEMPLATE_TEST.'admin/content',array(
			     'result' => $result
			));
		
			$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content'=>$content
											
										));
		
		
		return $this->page;
	}
}
?>