<?php

class Image {
	public $files;
public function __construct ($imgfile){
	
	$this->files=$imgfile;
}
	
	
	
public function p(){
	echo 55;exit();
}
	
public function check_error(){
		if(!empty($this->files['upload']['error'])) {
				 //проверка на ошибку в переменной error
	           $_SESSION['message'] = "<div class='alert-danger'>Ошибка при загрузке изображения</div>";
				header("Location:".$_SERVER[HTTP_REFERER]);
					exit();
		                 }
						
            if($this->files['upload']['size'] > '2097152'){
				     //если изображение не соответствует указаному размеру
				$_SESSION['message'] = "<div class='alert-danger'>Ошибка при загрузке изображения</div>";
				  header("Location:".$_SERVER[HTTP_REFERER]);
			}
return true;
	
}
	
public function tmp_save(){
	
	  if(!move_uploaded_file($this->files['upload']['tmp_name'],'images/'.$this->files['upload']['name'])) {
					 
					  $_SESSION['message'] = "<div class='alert-danger'>Ошибка копиррования изображения</div>";
						header("Location:".$_SERVER[HTTP_REFERER]);
					    exit();
				}
		return true;
}
	
public function check_format(){
	   if(!empty($this->files['upload']['type'])) {
		  //echo "<pre>";print_r($this->files);echo "</pre>";exit();
		   //проверка изображения на допустимый формат jpg, png, gif
		           $format=substr($this->files['upload']['type'],strpos($this->files['upload']['type'],'/'));
				   $format = trim($format,'/');
				   $img_types = array($format => $this->files['upload']['type']);
				   $type = array_search($this->files['upload']['type'],$img_types);
				  
				   if($type == 'jpeg' || $type == 'png' || $type =='gif'){
					return $type;
				   }else{
					    echo 500;exit();
					     	 $_SESSION['message'] = "<div class='alert-danger'>Допустимый формат изображений: jpg, png, gif</div>";
			             header("Location:".$_SERVER[HTTP_REFERER]);
					     exit();
				   }
					
	}
		
		
		else{
			  	 $_SESSION['message'] = "<div class='alert-danger'>Допустимый формат изображений: jpg, png, gif</div>";
			             header("Location:".$_SERVER[HTTP_REFERER]);
					     exit();
				   }
		}



	public function rand_str() {//создаем название для загружаемого изображения
		$str = md5(microtime());
		return substr($str,0,10);
	}
	

		public function img_resize($type){
			$dest = 'images/'.$this->files['upload']['name'];
			switch($type) {
			case 'jpeg':
				$img_id = imageCreateFromJpeg($dest);
				
			break;
		
			case 'png':
				$img_id = imageCreateFrompng($dest);
				
			break;
		
		  case 'gif':
				$img_id = imageCreateFromgif($dest);
				
			break;
		}
		$img_width = imageSX($img_id);
		$img_height = imageSY($img_id);
		
		$k = round($img_width/200,2);
		
		$img_mini_width = round($img_width/$k);
		$img_mini_height = round($img_height/$k);
		$w = 0;
		$h = 0;
		if($img_mini_height < 200){
			
			$h = (200-$img_mini_height)/2;
			
		}
		if($img_mini_height > 200){
			 while($img_mini_height >= 200){//проталкиваем цикл пока высота не будет равно или меньше 200
				 $width_save= $img_mini_width;//запоминаю предыдущую ширину
				 $img_mini_width = $img_mini_width - 10;//уменьшаю ширину на 10
				 $k = round($width_save/$img_mini_width,2);//смотрим на сколько уменьшилась ширина
				 $img_mini_height = round($img_mini_height/$k);//пропорционально уменьшаем высоту на столько на сколько уменьшилась ширина
				
				 
				 
			 }
  $h = (200-$img_mini_height)/2;//высота стала меньше 200 поэтому нужно вычислить так чтобы картинка разместилась вертикально по центру
  $w =  (200-$img_mini_width)/2;// ширина стала меньше 200 поэтому нужно вычислить так чтобы картинка разместилась ujhbpjynfkmyj по центру
		
		}
		$img_dest_id = imageCreateTrueColor(200,200);
		$color = imagecolorallocate($img_dest_id,255,255,255);//белый цвет
        imagefill($img_dest_id,0,0,$color);//закрашиваем подложку для картинки в белый цвет
		
		
			$result = imageCopyResampled(//наложение картинки на подложку
							$img_dest_id,
							$img_id,
							$w,//цетрируем по горизонтали
							$h,//центрируем по вертикали
							0,
							0,
							$img_mini_width,
							$img_mini_height,
							$img_width,
							$img_height
							);
	
		$name_img = $this->rand_str().'.jpg';
		
		if($type == 'jpeg'){
		
			$img = imageJpeg($img_dest_id,'images/img/'.$name_img,100);
		}
			if($type == 'png'){
			$img = imagepng($img_dest_id,'images/img/'.$name_img);
		}
			if($type == 'gif'){
			$img = imagegif($img_dest_id,'images/img/'.$name_img);
		}
		imageDestroy($img_id);	
		imageDestroy($img_dest_id);	
		if($img) {
			unlink('images/'.$this->files['upload']['name']);
			return $name_img;
		}	
		else {
			return FALSE;
		}			
		
	
	}





	
}







