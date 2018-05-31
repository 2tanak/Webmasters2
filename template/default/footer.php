

<?php 
global $validater;//языковый файл с валидацией, инициализация в точке входа 
global $label;//языковый файл с метками полей, инициализация в точке входа 
$dist = json_encode($validater);
$label = json_encode($label);

?>


<script type="text/javascript" src="<?=TEMPLATE_TEST?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?=TEMPLATE_TEST?>js/bootstrap.min.js"></script>
<script>var dist = <?=$dist?> </script>
<script>var label = <?=$label?> </script>
<script type="text/javascript" src="<?=TEMPLATE_TEST?>js/myscript.js"></script>
</body>
</html>