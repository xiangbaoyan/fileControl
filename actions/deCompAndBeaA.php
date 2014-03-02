<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
//require BASE_DIR . '/functions/copToMulDirFile.php';
$proDir = $_POST['proName'];

$tarDir = $proDir."/css";

$it = new RecursiveDirectoryIterator($tarDir);

foreach(new RecursiveIteratorIterator($it) as $file){

    if(is_file($file)){
        $cssData = file_get_contents($file);

        $cssData = str_replace("}", "}\r", $cssData);

        file_put_contents($file,$cssData);
    }
}

popWin("解压美化成功成功！！");