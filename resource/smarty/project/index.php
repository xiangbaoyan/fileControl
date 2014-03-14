<?php 

    require $_SERVER['DOCUMENT_ROOT']."/libs/Smarty.class.php";

    $smarty = new Smarty();

    $smarty->display("test.tpl");

?>