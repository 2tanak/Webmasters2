<div class='container'>
   <?if($_SESSION['user']):?>
       Добро пожаловать на сайт <?=$_SESSION['user']?>
   <?endif;?>
   <?if($result):?>
      <?foreach($result as $item):?>
         <h3><?=$item['title']?></h3>
       <?=$item['text']?>
  <?endforeach?>
  <?endif?>
</div>