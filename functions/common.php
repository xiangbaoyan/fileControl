<?php
/**
 * commonFun.php
 * 公共文件
 * 包含了对项目根目录的处理 BASE_DIR
 *
 */
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
if(!function_exists('popWin')){
    require BASE_DIR . "\\functions\\popWin.php";
}


$con = parse_ini_file(BASE_DIR."/config.ini");
$projectDir = str_replace(basename($con['proDir']),"finalPro",$con['proDir']);