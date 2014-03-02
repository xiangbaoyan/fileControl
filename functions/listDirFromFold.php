<?php
/**
 * 列出一个目录所有的目录名，放在一个数组$arr
 *
 * @param string $dir 传入目录
 * @param array $arr 修改的数组的地址;
 */
function listDirFromFold($dir,&$arr){
    $dirArr = scandir($dir);
    foreach($dirArr as $sunDir){

        if(is_dir($dir."/".$sunDir) && $sunDir!="." && $sunDir!=".."){
            listDirFromFold($dir."/".$sunDir,$arr);
            $arr[] = $sunDir;
        }
    }
}

