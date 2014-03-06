<?php
    require $_SERVER['DOCUMENT_ROOT'].'/functions/delNotes.php';
  $data = file_get_contents("data.css");




function callModImg($matches1)
{
    return "../images/" . basename($matches1[0]);
}

$pattern = "/url\((.*)\)/U";

$cssData = preg_replace_callback($pattern, "callModImg", $cssData);
    file_put_contents("data.css",$data);

