<?php
defined('DOSTUP') or exit('Access denied');

class Index_Controller extends Controller {
	
	
	

	protected function output($param) {
		
		$content = $this->view(TEMPLATE_TEST.'content',array());
		
			$this->page = $this->view(TEMPLATE_TEST.'index',array(
											'content' => $content,
											
										));
		unset($_SESSION['message']);								
		return $this->page;
	}
}
?>