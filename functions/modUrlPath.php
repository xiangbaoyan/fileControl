<?php
/**
 * 用于修改css文件中，背景图片的路径
 */


/**
 * @param $matches
 *
 * @return string
 */
function callUrl($matches)
{

    return "../images/" . basename($matches[0]);
}

function modUrlPath(&$data)
{

   $data = preg_replace_callback("/(?<=url\(\").+\.(png|jpg|gif)/", "callUrl",$data);
}