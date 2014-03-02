<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copToMulDirFile.php';


$proName = $_POST['proName'];

/*
 * 添加css文件到目录
 */
$dirCss = BASE_DIR . "\\resource\\css\\";
$it = new DirectoryIterator("$dirCss");
foreach ($it as $file) {
    //找到bootstrap的css文件
    if (strpos($file, "bootstrap") > -1) {
        $oldFile = $dirCss . $file;
        $newFile = $proName . '/css/' . $file;
        copToMulDirFile($oldFile, $newFile);
    }

}

/**
 * 添加js文件到目录
 *
 */

$dirJs = BASE_DIR . "/resource/js/";
$it = new DirectoryIterator($dirJs);

foreach ($it as $file) {
    //找到bootstrap的js文件
    if (strpos($file, "bootstrap") > -1 ||
        strpos($file, "html5shiv") > -1 ||
        strpos($file, "jquery.min") > -1 ||
        strpos($file, "respond.min") > -1
    ) {

        $oldFile = $dirJs . $file;
        $newFile = $proName . '/js/' . $file;
        copToMulDirFile($oldFile, $newFile);
    }
}
popWin("添加bootstrap成功");