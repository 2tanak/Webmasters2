<?php
defined('DOSTUP') or exit('Access denied');

class Switch_Controller extends Controller {
	
	
	

	
	protected function output($param=array()) {
		
			if($param['lang']){
			$data = time() + 30*24*60*60;
			$_SESSION['lang'] = ($param['lang']);
			setcookie('langtestname',$param['lang'],$data);
			header("Location:".$_SERVER[HTTP_REFERER]);exit();
		}
		
		
		
		
		
		
		$content = $this->view(TEMPLATE_TEST.'content',array());
		
			$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content' => $content,
											
										));
		return $this->page;
	}
}
?>