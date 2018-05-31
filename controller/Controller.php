<?php
class Controller {
	protected $controller;
	protected $params;
    protected $page;
	
	public function init() {
	
	 $this->router();	
     if(class_exists($this->controller)) {
	          $controller=new $this->controller;
		      $controller->request($this->params);
			
		}
		else {
			
			throw new Exception('страница - '.$this->controller.' не найдена в системе');
		}
	}


	

	
	protected function get_controller() {
		return $this->controller;
	}
	


	
	protected function output($param) {
		
	}
	
	public function request($param = array()) {
		$this->output($param);
		$this->get_page();
	}
	
	public function get_page() {
		echo $this->page;
	}
	
	protected function view($path,$param = array()) {
		
		extract($param);
		
		ob_start();
		
		if(!include($path.'.php')) {
			throw new ContrException('Данного шаблона нет');
		}
		
		return ob_get_clean();
	}
	

	

public function router(){
	
			if($_SERVER['HTTP_HOST'] === DOMEN) {
			  $zapros = $_SERVER['REQUEST_URI'];
			 
			  if(isset($_GET)){
				  $controller=trim($zapros,'/');
				      if(!empty($controller)){
				      if(strpos($controller,'?') === false){//если нет гет параметров
					       $this->controller = ucfirst($controller).'_Controller';//например, если пришел index то прилепим кнему Index_Controller
						    //если пришел register то станет Register_Controller
						}
					if(strpos($controller,'?') != false){//если есть гет параметры то в этом случае также создаем переменную $this->controller
						$controller=substr($controller,0,strpos($controller,'?'));
						 $this->controller = ucfirst($controller).'_Controller';
					}}else{
					    //если в адресной строке только домен то 
						$this->controller = "Index_Controller";//по умолчанию будет такой контроллер
					}
					 
				//далле делаем следущее: унас есть переменная $request, пишем такой код чтобы переменные в гет запросе стали ключами масива, а значением масива стали значение гет параметры, этот масив ложим в переменную $this->params
				 
       
			$request= $_SERVER[QUERY_STRING];//получаем все гет параметры в переменную например: name = вася&family=иванов
			if(!empty($request)){
			     $arr = explode('&',$request);
		         $url=array();
			    $arr_tmp=array();
			    foreach($arr as $item){//создадим массив, где ключами будут ключи гет запроса а значениями будут значение гет запроса
		
				 $arr_tmp=explode('=',$item);
				 if(!empty($arr_tmp[0]) && !empty($arr_tmp[1])){
					  $url[$arr_tmp[0]] = $arr_tmp[1];
				 }else{
				     throw new Exception('<p style="color:red">Не правильный get параметр: не принимаются нулевые значения, и параметры без значений.</p>');

				 }
				unset($arr_tmp);
			}
			   $this->params = $url;
				
			}
			
			
		
			
			}
		}
		else {
			try{
				throw new Exception('<p style="color:red">Не правильный адрес.</p>');
			}
			catch(Exception $e) {
				echo $e->getMessage();
				exit();
			}
		}
	
	
}
	

	
}
	

	

	

?>