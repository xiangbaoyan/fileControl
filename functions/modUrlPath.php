<?php
/**
 * 用于修改css文件中，背景图片的路径
 */


/**
 * @param $matches
 *
 * @return string
 */
$subCon = "../images/";
function callUrl($matches)
{
   global $subCon;
    return  $subCon . basename($matches[0]);
}

function modUrlPath(&$data)
{

   $data = preg_replace_callback("/(?<=url\().+\.(png|jpg|gif)\"?/", "callUrl",$data);
}