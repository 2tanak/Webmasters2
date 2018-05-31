</br>
 <?php global $label;?><!-----------------------подключение языка с метками полей--------------------------------->
 <?php global $titleheader?><!-----------------------подключение языка с загаловками--------------------------------->
  <!-- Блок для ввода логина -->
<h3 style='text-align:center'><?=$titleheader['auth']?></h3>
		
<div class='' style='clear:both'></div>		
    <form  id='form' action='/login' method='POST' role="form" class="form-horizontal col-md-6 clearfix col-md-push-3" >
	    <div class="col-md-12">
           <div class="form-group">
               <label class="control-label" for="login"> <?=$label['login']?></label>
	           <input type="text" class="form-control input" id="login2" name='login' value="">
	           <div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
            </div>
         <input type='hidden'  name='xss' value="<?=$_SESSION['xss']?>">

       <div class="form-group">
           <label class="control-label" for="pass"><?=$label['pass']?></label>
           <input type="password" class="form-control input" id="pas" value="" name='pas'>
	       <div style='text-align:left;padding:0;margin:0;' class="control-label error"></div>
      </div>
	  
     <div class="form-group">
         <input type='submit' class='btn btn-info' value="<?=$label['send']?>">
     </div>
   </div>
</form>