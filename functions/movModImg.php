<?php
if(!function_exists('copToMulDirFile')){
    require "copToMulDirFile.php";
}

function callProImgDel($matches)
{
    if (!preg_match("/(\.gif|\.jpg|\.png)/", $matches[0])) {
        return "";
    }
    return $matches[0];
}

/**
 * 移动目标css文件里的img成模块
 *
 * @param string $data 传入的css文件数据
 */
function movModImg(&$data)
{


    //删除多余的backgroundUrl
    $data = preg_replace_callback("/background:url.*;/", "callProImgDel", $data);


    //从外部引用目标模块路径
    global $modDir, $proDir;

    //取得$data里的img路径
    //原始正则(?<=url\(\")[^\"]*
    $pattern = "/(?<=url\(\")[^\"]*/";
    preg_match_all($pattern, $data, $matches);
    //matches[0]里面每个背景图片的路径进行处理
    foreach ($matches[0] as $path) {
        //取得final文件夹的images 即oldFile;
        $oldFile = $proDir . $path;
        $newFile = $modDir . $path;
        if(file_exists($oldFile)){
          copToMulDirFile($oldFile, $newFile);
        }
    }
       $data = str_replace("/images","images",$data);
}

