<?php
/**
 * 修改CSS文件中的url路径
 */

require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . "/functions/modUrlPath.php";
require BASE_DIR . "/functions/delNotes.php";

$con = parse_ini_file(BASE_DIR . "/config.ini");
$proDir = $con['proDir'];
echo $proDir;
$it = new DirectoryIterator($proDir . "/css");

foreach ($it as $file) {
    if (!$it->isDot()) {
        $data = file_get_contents($proDir . "\\css\\" . $file);
        delNotes($data);
        modUrlPath($data);
        file_put_contents($proDir . "\\css\\" . $file, $data);
    }
}


//popWin("修改css文件中Url成功");