<?php
defined('DOSTUP') or exit('Access denied');
class Image_Controller extends Controller {

	
	
	
protected function output($param) {
$img = imagecreatetruecolor(500,500);
$grey = imagecolorallocate($img,233,233,233);
$black = imagecolorallocate($img,0,0,0);

imagefill($img,0,0,$grey);
//imagefilledrectangle($img,0,0,300,150,$black);
$img1 = imageCreateFromjpeg(TEMPLATE_TEST.'2.jpg');
imagecopy($img,$img1,0,0,0,0,350,300);
	header('Content-Type:image/jpg');
	imagepng($img);
	imagedestroy($img);

}
}
?>