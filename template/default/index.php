
<?php require 'header.php'?>
	<!--------вывод ошибок--------->
	
<div class='both'></div>
	<?if(!empty($_SESSION['message'])):?>
	<div class='container'>
	    <?=$_SESSION['message']?>
		</div>
	<?endif?>
<div class='both'></div>	
<?=$content;?>
<div class='both'></div>
	

<?php require 'footer.php'?>

