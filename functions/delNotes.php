<?php
/**
 * 去除所有注释
 *
 * @return string
 */
function  delNotes(&$data)
{
    /*
    * 去除注释
    */
    $data = preg_replace("/\/\*[\s\S]*\*\//U", "", $data);
    $data = preg_replace("/<!--[\s\S]*-->/U", "", $data);
    $data = preg_replace("/tppabs=\"[\S]*\"/U","",$data);

    $data = preg_replace("/\@charset[^;]*;/U","",$data);
 //   $data = "@CHARSET \"UTF-8\";".$data;
    return $data;
}

