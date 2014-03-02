<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/commonFun.php';
require BASE_DIR . '/functions/copToMulDirFile.php';


$pageName = $_POST['pageName'];
if(!trim($pageName)){
    popWin("请输入要生成页面的名字");
    exit;
}


/*
 * 要组合的所有divs $divs
 */
$nums = $_POST['nums'];
if(!$nums){
    popWin("顺序没有指定");
    exit;
}
$divs = explode(",",$nums);

/*
 * 要生成新的项目  finalPro
 */
$con = parse_ini_file(BASE_DIR."/config.ini");
$projectDir = str_replace(basename($con['proDir']),"finalPro",$con['proDir']);

/*
 * 移动所有图片
 */
foreach($divs as $div){
    //要移动的图片的目录sourceDir
    $sourceDir = BASE_DIR."/modules/div".$div.'/images';
    //移动过去的目录为
    $desDir = $projectDir."/images";
    if(is_dir($sourceDir)){
        $it = new DirectoryIterator($sourceDir);
        foreach($it as $file){
            if(is_file($sourceDir."/{$file}")){
                copToMulDirFile($sourceDir."/{$file}",$desDir."/{$file}");
            }
        }
    }

}


/*
 * 合并所有index.php文件
 */
//从资源文件夹中拷贝一个index.php  的主页面过去，

copToMulDirFile(BASE_DIR."/resource/index.php",$projectDir."/{$pageName}.php");

//合并所有index.php
//做一个函数 ，为div 添加 到index.php

/**
 * 添加一个模块页面index.php的数据
 *
 * @param string $div   模块的div，是个数字
 * @param string $data 这是生成的项目 页面 的数据
 */
function putDivData($div,&$data){
    //先得到div 模块index.php 页面的数据；
    $sourcePage = BASE_DIR."/modules/div".$div."/index.php";
    //得到页面的数据
    $sourceData = file_get_contents($sourcePage);
    //修改数据，去掉link
    $sourceData =  preg_replace("/<link[^\>]*>/U","",$sourceData);
    //添加到$data 的<body>的下面
    //注意，必须先添加最后一个div，所以让divs倒序
    $data = str_replace("<body>","<body>\r{$sourceData}\r",$data);
};
//注意，必须先添加最后一个div，所以让divs倒序
$divs = array_reverse($divs);
//打开目标页面的数据；
$data = file_get_contents($projectDir."/{$pageName}.php");
//为页面添加css的 link 链接
$data = str_replace("</title>",
    "</title>\r<link rel=\"stylesheet\" type=\"text/css\" href=\"css/{$pageName}.css\"/>",$data);
foreach($divs as $div){

    putDivData($div,$data);
}

file_put_contents($projectDir."/{$pageName}.php",$data);

//移动test3-final 的 相关 css们 并合并 到finalPro项目
//得从index 提交的页面，获得相关的css们
session_start();
//取得test3-final 的page 名称
$proFile = $_SESSION['file'];
/**
 * 找到相关的css
 */
$_name = substr(basename($proFile),0,-4);

$it =  new RecursiveDirectoryIterator($con['proDir']);
$pattern= "/{$_name}[\d]*.css/";
$cssData="";
foreach(new RecursiveIteratorIterator($it) as $file){

    if(preg_match($pattern,basename($file))){
        $cssData .= "\r".file_get_contents($file);
    }
};
mkdir($projectDir."/css");
file_put_contents($projectDir."/css/{$pageName}.css",$cssData);
    header("location: http://127.0.0.3");
session_destroy();
exit;