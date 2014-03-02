<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/delDir.php';

delDir(BASE_DIR."/modules");
mkdir(BASE_DIR."/modules");


echo $_SERVER['HTTP_REFERER']."<br>";


if(strpos($_SERVER['HTTP_REFERER'],"peek")){
    header("location: http://{$_SERVER['SERVER_NAME']}/peek.php");
} else{
    popWin("清空已完成");
}



