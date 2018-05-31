<?php
define('DOSTUP',TRUE);

header("Content-Type:text/html;charset=utf-8");

//error_reporting(0);

session_start();
if(isset($_SESSION['xss'])){//подключаем защиту от xss атак

	//setcookie('xss', '', time() - 360000);
}else{
	
$str = time();
$k=substr($str,0,40);
$_SESSION['xss']=$k;

}


//меняем язык
if(isset($_SESSION['lang'])){

	$dist = include 'lang/'.$_SESSION['lang'].'/menu.php';
	$label = require 'lang/'.$_SESSION['lang'].'/label_form.php';
	$validater = require 'lang/'.$_SESSION['lang'].'/javascript_validate.php';
	$titleheader = require 'lang/'.$_SESSION['lang'].'/title.php';
	$lang_message = require 'lang/'.$_SESSION['lang'].'/message.php';
}
else if(!empty($_COOKIE['lang']) || isset($_COOKIE['lang'])){
	
	$_SESSION['lang'] = $_COOKIE['lang'];
	
}

else{//если нет сессии и куки тогда выставляем значение по умолчанию в русский язык

	$_SESSION['lang'] = 'ru';
	$dist = include 'lang/ru/menu.php';
	$label = require 'lang/ru/label_form.php';
	$validater = require 'lang/ru/javascript_validate.php';
	$titleheader = require 'lang/ru/title.php';
	
	$lang_message = require 'lang/ru/message.php';
	
}







require "config.php";

set_include_path(get_include_path()
				.PATH_SEPARATOR.CONTROLLER
				.PATH_SEPARATOR.MODEL
				.PATH_SEPARATOR.LIB
				);

function __autoload($class_name) {
	

	if(!include_once ($class_name.".php")) {
		
		try {
			throw new Exception($class_name.'Не правильный файл для подключения');
		}
		catch(Exception $e) {
echo $e->getMessage();exit();
		}
	}
}
try{
	$obj = new Controller;
	$obj->init();
}
catch(Exception $e) {
	//echo 300;exit();
header("Location:".'/'.'error?mess='.rawurlencode($e->getMessage()).'&file='.rawurlencode($e->getFile()).'&line='.rawurlencode($e->getLine()));exit();
	
}


?>