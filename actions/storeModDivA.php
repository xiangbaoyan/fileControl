<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copDirToDir.php';

$addrFile = $_POST['addrFile'];
$divName = $_POST['divName'];

$nav = $_POST['cate'];


if (!$divName) {
    popWin("请指定一个模块名称");
}

if(is_dir(BASE_DIR."/resource/modules/{$nav}/{$divName}")){
    popWin("该模块在储存箱里已经存在");
    exit;
}

if (!empty($nav)) {
    //就是复制文件夹；
    //这里面，desDir，就是BASE_DIR . "/resource/modules/{$nav}
    //sourDir 就是dirname($addrFile);

    //定义：
    $desDir = BASE_DIR . "/resource/modules/{$nav}";
    $sourDir = dirname($addrFile);


    copDirToDir($desDir , $sourDir,$divName);
//    $it = new RecursiveDirectoryIterator(dirname($addrFile));
//
//    foreach (new RecursiveIteratorIterator($it) as $file) {
//        if (is_file($file)) {
//
//            $newFile = str_replace($dir, BASE_DIR . "/resource/modules/{$nav}/{$divName}", $file);
//            copToMulDirFile($file, $newFile);
//
//        }
//    };
    popWin("成功储存");

} else {
    popWin("请选择目录");

}




