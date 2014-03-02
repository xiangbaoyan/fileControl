<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/commonFun.php';
require BASE_DIR . '/functions/creModCssData.php';

$tarDir = BASE_DIR."/modules";

$it =  new RecursiveDirectoryIterator($tarDir);

foreach(new RecursiveIteratorIterator($it) as $file){
    if(strpos($file,".php")>-1){

        $sourCssFile = str_replace(".php",".css",$file);
        $data = file_get_contents($file);
        $data = creModCssData($data,array($sourCssFile));
       file_put_contents($sourCssFile,$data);
    }
}
popWin("更新临时modules 里的css成功");