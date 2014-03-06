<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/delNotes.php';
require BASE_DIR . '/functions/modSimCssPath.php';
require BASE_DIR . '/functions/modSimJsPath.php';
require BASE_DIR . '/functions/modImgPath.php';
require BASE_DIR . '/functions/modHtmToPhp.php';

$con = parse_ini_file(BASE_DIR."/config.ini");
$proDir = $con['proDir'];
$it = new RecursiveDirectoryIterator($proDir);

foreach (new RecursiveIteratorIterator($it) as $file) {
    if (preg_match('/(.php|.html)$/', $file)) {
        $data = file_get_contents($file);
        delNotes($data);
        modSimCssPath($data);
        modSimJsPath($data);
        modImgPath($data);
        modHtmToPhp($data);
        file_put_contents($file, $data);
    }
}



function callModImg($matches1)
{
    return "../images/" . basename($matches1[0]);
}
//修改所有的css里的图片路径
$it =  new RecursiveDirectoryIterator($proDir."/css");
foreach(new RecursiveIteratorIterator($it) as $file){
    if(is_file($file)){
        $cssData = file_get_contents($file);

        delNotes($cssData);
        // 修改url
        $pattern = "/[^\"\(\)\*]*\.(gif|png|jpg)/U";

        $cssData = preg_replace_callback($pattern, "callModImg", $cssData);
        file_put_contents($file, $cssData);
    }
}

popWin("修改成功");
