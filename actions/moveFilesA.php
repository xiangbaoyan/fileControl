<?php
require $_SERVER['DOCUMENT_ROOT'] . "/functions/common.php";
require BASE_DIR . "/functions/moveFiles.php";

$con = parse_ini_file(BASE_DIR . "/config.ini");
$proName = $con['proName'];
$proDir = $con['proDir'];

if (!is_dir($proName)) {
    popWin("配置文件的源目录不存在");
}
moveFiles();



