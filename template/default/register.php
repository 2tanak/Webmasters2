</br>
  <!-- Блок для ввода логина -->
  <?php global $label;?>
  <?php global $titleheader?>
<h3 style='text-align:center'><?=$titleheader['registr']?></h3>
		
<div class='' style='clear:both'></div>		
<form  id='form' action='/register' method='POST' role="form" class="form-horizontal col-md-6 clearfix col-md-push-3" style='border:1px solid #ccc;padding-top:20px;padding-bottom:20px' enctype="multipart/form-data">
		 <div class="col-md-12">


<div class="form-group">


    <label class="control-label" for="login"><?=$label['login']?></label>
	<input type="text" class="form-control input" id="login" name='login' value="<?php if($_SESSION['povtor']['login']);{echo $_SESSION['povtor']['login'];}?>">
	<div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
</div>

<div class="form-group">

    <label class="control-label" for="email">email</label>
    <input type="text" class="form-control input" id="email" value="<?php if($_SESSION['povtor']['email']);{echo $_SESSION['povtor']['email'];}?>" name='email'>
	<div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
</div>
<div class="form-group">
   <label class="control-label" for="pass"><?=$label['pass']?></label>
    <input type="password" class="form-control input" id="pass" name='pass'  value="">
	<div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
</div>
<div class="form-group">
   <label class="control-label" for="pass"><?=$label['repass']?></label>
    <input type="password" class="form-control input" id="repass" value="" name='repass'>
	<div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
</div>
<input type='hidden'  name='xss' value="<?=$_SESSION['xss']?>">

<div class="form-group">
   <label class="control-label" for="pass"></label>
    
	  <input type="file" id="uploadInput" name="upload"/>
	<div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
</div>



<div class="form-group">
<input type='submit' class='btn btn-info' value="<?=$label['send']?>">
</div>
	</div>
	</form>
	
	

	
	
	
	
	