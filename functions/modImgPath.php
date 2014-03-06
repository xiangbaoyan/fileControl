<?php
/**
 * 函数modResPath 里的 preg_replace_Path 使用的回调函数
 *
 * @param array $matches 回调函数
 */
function callProImg($matches)
{
    return "images/" . basename($matches[0]);
}



/**
 * 修改资源文件的路径名
 *
 * @param string $data 传入文件名
 *
 */
function modImgPath(&$data)
{

    //找到每一个backgroundurl 如果里面不包含.gif.jpg.png就删除掉


    $data = preg_replace_callback("/[^\'\"]*(\.gif|\.jpg|\.png)/", "callProImg", $data);
}
