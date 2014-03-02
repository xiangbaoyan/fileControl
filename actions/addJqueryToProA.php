<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copToMulDirFile.php';

$proDir = $_POST['proName'];

$oldJquery = BASE_DIR . "/resource/js/jquery.min.js";

$newJquery = $projectDir . "/js/jquery.min.js";

copToMulDirFile($oldJquery, $newJquery);

//如果提交过来的是页面还得，为页面提交jquery支持;

if (is_file($proDir)) {


    $data = file_get_contents($proDir);

    $data = str_replace("</head>", "<script src=\"/js/jquery.min.js\"></script>\r</head>", $data);

    file_put_contents($proDir, $data);

}

popWin("添加Jquery成功");