<?php

require $_SERVER['DOCUMENT_ROOT'] . '/functions/commonFun.php';
require BASE_DIR."/functions/delDir.php";

$con = parse_ini_file(BASE_DIR."/config.ini");

$tarDir =  str_replace(basename($con['proDir']),"finalPro",$con['proDir']);


delDir($tarDir);
mkdir($tarDir);

popWin("成功清除");