<?php
if(!function_exists('creMulDir')){
    require "creMulDir.php";
}
/**
 * 复制一个文件到目标不存在多级目录的新文件
 * 此函数依赖creMulDir.php
 *
 * @param $oldFile
 * @param $newFile
 */
function copToMulDirFile($oldFile, $newFile)
{
    creMulDir(dirname($newFile));
    copy($oldFile, $newFile);
}