<?php

require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/delDirFun.php';

$fileName = $_GET['name'];


//删除目录;

$dir = dirname($fileName);

delDir($dir);

echo "<script>alert(\"删除成功\");location.href=\"/peek.php\"</script>";


