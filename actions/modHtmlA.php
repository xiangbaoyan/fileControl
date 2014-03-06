<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/delNotes.php';
require BASE_DIR . '/functions/modCssPath.php';
require BASE_DIR . '/functions/modJsPath.php';
require BASE_DIR . '/functions/modImgPath.php';
require BASE_DIR . '/functions/modHtmToPhp.php';

//$con = parse_ini_file(BASE_DIR . "/config.ini");
$proDir = @$_POST['proDir'];

$it = new RecursiveDirectoryIterator($proDir);

foreach (new RecursiveIteratorIterator($it) as $file) {
    if (preg_match('/(.php|.html)$/', $file)) {
        $data = file_get_contents($file);
        delNotes($data);
        modCssPath($data);
        modJsPath($data);
        modImgPath($data);
        modHtmToPhp($data);
        file_put_contents($file, $data);
    }
}
session_destroy();
popWin("修改成功");
