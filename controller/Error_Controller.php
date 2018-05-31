<?php
class Error_Controller extends Controller {
	

	
	protected function output($param) {
		
		
		$er = '';
		$arr = array();
		if(isset($param['mess'])) {
			
			foreach($param as $key=>$val) {
				$val = rawurldecode($val);
				$arr[] = $key.': &nbsp&nbsp&nbsp'.$val;
				
				$er .= $key.' - '.$val.'|';
				
			}
			
	
			$error = $arr;
			
		}
		
		
		
		
		
		
			$content = $this->view(TEMPLATE_TEST.'error_page',array(
			 'error'=>$error,
			));
		
		$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content' => $content,
											
										));
		
		
		
		unset($_SESSION['message']);
		return $this->page;
	}
}
?>