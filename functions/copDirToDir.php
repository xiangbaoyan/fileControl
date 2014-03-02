<?php
if(!function_exists('copToMulDirFile')){
    require 'copToMulDirFile.php';

}

/**
 * 拷贝一个文件夹到另一个文件夹的里面，要指定新文件夹的名字
 *
 * @param string $desDir 目标文件夹
 *
 * @param string $sourDir 原文件夹
 *
 * @param string $desDirBaseName 目的文件夹的baseName
 */
function copDirToDir($desDir, $sourDir,$desDirBaseName) {
    $it = new RecursiveDirectoryIterator($sourDir);

    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (is_file($file)) {
            //这里面，desDir，就是BASE_DIR . "/resource/modules/{$nav}
            $newFile = str_replace($sourDir, $desDir."/".$desDirBaseName, $file);
            copToMulDirFile($file, $newFile);

        }
    };

}

