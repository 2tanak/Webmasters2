
<?php require 'header.php'?>
	<!--------вывод ошибок--------->
<div class='clear-fix' style='clear:both'></div>	
	
	<?if(!empty($_SESSION['message'])):?>
	<div class='container'>
	    <?=$_SESSION['message']?>
		</div>
	<?endif?>
<?=$content;?>

	

<?php require 'footer.php'?>

