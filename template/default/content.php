<div class='container'>
    <?if($_SESSION['user']):?>
        Добро пожаловать на сайт <?=$_SESSION['user']?>
    <?else:?>
       <div>
         <p style='font-size:30px;margin-top:100px'>Вы не авторизированы на сайте</p>
         <p>зайдите на сайт под своим логином и паролем, и вам будет доступен закрытый раздел
         </p>
       </div>
    <?endif;?>
</div>