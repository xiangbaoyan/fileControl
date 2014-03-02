<?php
require $_SERVER['DOCUMENT_ROOT'] . "/functions/commonFun.php";
require BASE_DIR . "/functions/listDirFromFold.php";

$con = parse_ini_file(BASE_DIR . "/config.ini");
$js = parse_ini_file(BASE_DIR . "/js.ini");

/*
 * 删除所有多余的config.ini 文件里的参数项
 */
//读取目录functions 的所有文件

$conFiles1 = scandir(BASE_DIR . '/functions');
$conFiles2 = scandir(BASE_DIR . "/actions");
$conFiles = array_merge($conFiles1, $conFiles2);

foreach ($con as $para => $value) {
    if (!in_array($para, $conFiles) && $para != "proName" && $para != "proDir") {
        //转义$para 里的.
        $para = preg_quote($para);
        /*
         * 删除这个参数：
         */
        $data = file_get_contents(BASE_DIR . "/config.ini");
        $pattern = "/" . $para . "=\"[^\"]*\"/";
        $data = preg_replace($pattern, "", $data);
        file_put_contents(BASE_DIR . "/config.ini", $data);
    }
}

/*
 * 删除所有多余的js.ini 文件里的参数项
 */


$jsDir = BASE_DIR."/resource/jsFunctions";
$jsFiles = scandir($jsDir);
foreach ($js as $para => $value) {

    if (!in_array($para, $jsFiles)) {
        //转义$para 里的.
        $para = preg_quote($para);
        /*
         * 删除这个参数：
         */
        $data = file_get_contents(BASE_DIR . "/js.ini");
        $pattern = "/" . $para . "=\"[^\"]*\"/";
        $data = preg_replace($pattern, "", $data);
        file_put_contents(BASE_DIR . "/js.ini", $data);
    }

}
popWin("ini更新成功");