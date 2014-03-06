<?php
if(!function_exists("copToMulDirFile.php")){
    require "copToMulDirFile.php";
}
/**
 * 1.移动文件到目标目录的相应文件夹
 * 2.写入common文件到目标文件夹的include
 *
 * $proDir 代表目标文件夹，$proName 代表源文件夹
 * @global $proDir ,$proName
 *
 * @return void
 */
function moveFiles()
{

    global $proDir, $proName;

    /*
     * 新建所有的目录
     */
    $dirs = array($proDir, $proDir . "/css", $proDir . "/js",$proDir . "/images");
    for ($i = 0; $i < sizeof($dirs); $i++) {
        if (!is_dir($dirs[$i])) {
            mkdir($dirs[$i]);
        }
    }
    /* 写入include 的common文件；
     */
//    if (!is_file($proDir . "\\include\\commonFun.php")) {
//        copy(BASE_DIR . "\\resource\\commonFun.php", $proDir . "\\include\\commonFun.php");
//    }
    /* 遍历文件夹所有js，css文件并移动到相应目录
     */
    $it = new RecursiveDirectoryIterator($proName);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (preg_match("/\.css$/", $file)) {
            copy($file, $proDir . "/css/" . basename($file));
        }
        if (preg_match("/\.js$/", $file)) {
            copy($file, $proDir . "/js/" . basename($file));
        }

        if (preg_match("/(\.gif|\.jpg|\.png)$/",$file)) {
            copy($file, $proDir . "/images/" . basename($file));
        }
        if (preg_match("/(\.html|\.htm|\.php)$/", $file)) {
            //移动文件，就是修改文件名到指定的目录
            $desPath = str_replace($proName, $proDir, $file);
            //并把后缀名改成.php
            if(preg_match('/(.html|.htm)/',$desPath)){
                $desPath = preg_replace('/(.html|.htm)/', ".php", $desPath);
            }
            //改名移动
            copToMulDirFile($file, $desPath);
        }
    }
    popWin("整理成功");
}