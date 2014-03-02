<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/commonFun.php';
require BASE_DIR."/functions/copDirToDir.php";

$mod = $_POST['mod'];

$divName =  $_POST['divName'];
$divName = trim($divName);

if(!$divName || $divName=="div" || $divName=="div1"){
    popWin("没有指定到工程里的div名称");
    exit;
}
$modDir = dirname($mod);



//写明目标目录
$desDir = BASE_DIR."/modules";
copDirToDir($desDir,$modDir,$divName);

echo "<script>alert(\"添加成功\");window.location.href=\"/peek.php\";</script>";

exit;