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
    echo "----------"."<br>";
    echo $subCon . basename($matches[0])."<br>";
    return  $subCon . basename($matches[0]);
}

function modUrlPath(&$data)
{
   $data = preg_replace_callback("/(?<=url\().+\.(png|jpg|gif)\"?/U", "callUrl",$data);
}