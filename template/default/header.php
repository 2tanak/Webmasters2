<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title;?></title>
    <link rel="stylesheet" type="text/css" href="<?=TEMPLATE_TEST?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=TEMPLATE_TEST?>css/style.css" />

</head>

<body>

<div class='menu-top'>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills nav-justified centers">
        <li class="">
		 <!---подключение файла языков, подключение в точке входа 
		 создал класс Lan, который возвращает значение из файла перевода по ключу например Lan::_('HOME');возвратит слово 'главная'
		 ------------------------------------->
	

<? global $dist?>
		
		<a href="/"><?=$dist['HOME'];?> <span class="sr-only">(current)</span></a>
		</li>
		   <li class="">
		<a href="/admin"><?=$dist['PRIVATE'];?><span class="sr-only">(current)</span></a>
		</li>
		
        <li><a href="/register"><?=$dist['REGISTER'];?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		   <?=$_SESSION['user'] ? $_SESSION['user'] : $dist['AVTORIZATION']?><span class="caret">
		  </span>
		  </a>
          <ul class="dropdown-menu">
		   <li><?=$_SESSION['user'] ? '' : '<a href="/login">войти</a>';?></li>
		 
		 
            <li><a href="/login?logout=logout">выйти</a></li>
             </ul>
        </li>
		
		      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		 <?=$dist['LANG'];?><span class="caret">
		  </span>
		  
		  </a>
          <ul class="dropdown-menu">
            <li><a href="/switch?lang=ru">русский</a></li>
            <li><a href="/switch?lang=en">английсктй</a></li>
         
          </ul>
        </li>
		
      </ul>
  
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>



