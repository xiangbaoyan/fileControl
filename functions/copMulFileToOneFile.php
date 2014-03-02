<?php

/**
 * 拷贝多个文件的内容到一个文件，并指明存放在这个文件的位置
 *
 * @param array $filePathArray 多个文件的数组
 * @param string $desFilePath 目标文件
 * @param string $desPos 就是一个字符串，用来被替换
 */
function copMulFileToOneFile($filePathArray, $desFilePath, $desPos, $scriptTag = "")
{

    if ($scriptTag != "") {
        $endScriptTag = str_replace("<", "</", $scriptTag);
    } else {
        $endScriptTag = "";
    }

    if (count($filePathArray) > 0 && is_file($desFilePath)) {

        $data = "";


        foreach ($filePathArray as $filePath) {
            $data .= "\r" . file_get_contents($filePath);
        }
        $pageData = file_get_contents($desFilePath);
        $pageData = str_replace($desPos, $desPos . "\r{$scriptTag}" . $data . "\r{$endScriptTag}", $pageData);
        file_put_contents($desFilePath, $pageData);
        popWin("成功输入");

    } else {
        popWin("添加内容失败");
    }

}