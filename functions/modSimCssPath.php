<?php
if (!function_exists("delNotes")) {
    require $_SERVER['DOCUMENT_ROOT'] . "/functions/delNotes.php";
}

function callProCss($matches)
{

    return "css/" . basename($matches[0]);
}


function modSimCssPath(&$data)
{
    /*
     * 如果是css文件
     */
    $data = preg_replace_callback("/(?<=href\=\")[^\"]+\.css/U", "callProCss", $data);
}