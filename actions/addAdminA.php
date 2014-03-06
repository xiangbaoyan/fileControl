<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copDirToDir.php';



$sourDir = BASE_DIR."/resource/admin";
$desDir = @$_POST['proName'];

if($sourDir && $desDir){

    copDirToDir($desDir,$sourDir,"admin");

}else{
    popWin("两个目录有错");
}

