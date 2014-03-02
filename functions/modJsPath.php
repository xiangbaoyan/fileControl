<?php
if(!isset($_SESSION)){session_start();}
/**
 * 函数modResPath 里的 preg_replace_Path 使用的回调函数
 *
 * @param array $matches 回调函数
 */
function callProJs($matches) {

    global $file,$i,$proDir;
    //新的文件
    $i++;
    $newFile = $proDir."\\js\\".substr(basename($file),0,-4)."{$i}.js";
    //旧的文件
    preg_match("/[^\/]*.js/",$matches[0],$arr);
    $jsFile = $proDir."\\js\\".$arr[0];


    if(!file_exists($jsFile)){
        /*
         * 如果从目录中找到不到这个文件，则需要看他是否被修改了
         * 如果被修改了，则用被修改的文件名组成新路径
         */
        //判断如果被修改了
        if(!empty($_SESSION[$jsFile])){
            //修改了就不用改文件名了，直接改路径
            return "/css/".basename($_SESSION[$jsFile]);
        }

        return null;
    }
    //如果存在这个文件，则直接就修改这个文件名和路径，
    //修改了就要存在session里面
    $_SESSION[$jsFile] = $newFile;


    rename($jsFile,$newFile);
    return "/js/".substr(basename($file),0,-4)."{$i}.js";
}


/**
 * 修改资源文件的路径名
 *
 * @param string $data 传入文件名
 *
 */
function modJsPath(&$data) {
        /*
         * 如果是js文件
         */

        $i = 1;

       $data = preg_replace_callback("/[^\"]*\.js/","callProJs",$data);

    }