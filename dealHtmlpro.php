<?php
if(@$_GET['action']=='deal'){
        require $_SERVER['DOCUMENT_ROOT']."/functions/common.php";
        require $_SERVER['DOCUMENT_ROOT']."/functions/copToMulDirFile.php";
        require $_SERVER['DOCUMENT_ROOT']."/functions/delNotes.php";
        require $_SERVER['DOCUMENT_ROOT']."/functions/modUrlPath.php";
        $tarPage = @$_POST['tarPage'];
        $workDir = @$_POST['workDir'];
        $tarDir = dirname($tarPage);

        //分析这个页面的数据
        $tarData = file_get_contents($tarPage);
        //去除tppabs 和注释
        delNotes($tarData);


        /*
         * 首先要移动页面当中的所有css文件和js文件还有图片到目标目录
         */
        //创建css目录

        if(!is_dir($workDir."/css")){

            mkdir($workDir."/css");
        }

        if(!is_dir($workDir."/images")){

            mkdir($workDir."/images");
        }
        /*
         * 移动css文件；并替换路径
         */
        //但是必须默认的是相对路径例如href="assets/plugins/font-awesome/css/font-awesome.min.css"
        function replaceAndMove($matches){
            global $tarDir,$workDir;
            //源css的地址
            $oldCssFile = $tarDir."/".$matches[0];
            if(file_exists($oldCssFile)){
                //开始移动文件
                $newCssFile = $workDir."/css/".basename($oldCssFile);
                //还要移动css文件中的图片
                $cssData = file_get_contents($oldCssFile);
                //删除注释
                delNotes($cssData);
                //修改路径
                modUrlPath($cssData);
                //移动图片

                file_put_contents($newCssFile,$cssData);
            }
            return "css/".basename($oldCssFile);
        }

        $tarData = preg_replace_callback("/(?<=href\=\")[^\"]+\.css/U","replaceAndMove",$tarData);




        /*
         * 拷贝修改后的页面过去
         */
        file_put_contents($workDir."/".basename($tarPage),$tarData);

    }



//
//
//        function replaceCss($matches){
//            $newPath = "css/".basename($matches[0]);
//            return $newPath;
//        }
//
//        //修改路径，修改css路径:
//        $tarData = preg_replace_callback("/(?<=href\=\")[^\"]*\.css/","replaceCss",$tarData);
//
//        file_put_contents($tarPage,$tarData);
//
//
//
//
//
//
//        /*
//         * 拷贝这个页面过去
//         */
//        copToMulDirFile($tarPage,$workDir."/".basename($tarPage));
//
//        /*
//         * 考取所有css文件
//         */
//        //这里默认截取到的css路径是相对路径例如 media/fun
//        foreach($matches[0] as $cssFile){
//
//            $cssOldFile = $tarDir."/".$cssFile;
//            //找到cssData 里的图片考取图片
//            $cssData = file_get_contents($cssOldFile);
//            preg_match_all("/(?<=url\()[^\)]*/",$cssData,$preArr);
//            foreach($preArr[0] as $imgPath){
//                $imgPathOld = preg_replace("/\.{2}/",$tarDir."/media",$imgPath);
//                $newPath = $workDir."/media".preg_replace("/\.{2}/","",$imgPath);
//                if(is_file($imgPathOld)){
////                    echo "imgPathOld".$imgPathOld."<br>";
////                    echo "newPath".$newPath."<br>";
//            copToMulDirFile($imgPathOld,$newPath);
//                }
//            }
//
//
//            $newFile = $workDir."/".$cssFile;
//            copToMulDirFile($cssOldFile,$newFile);
//        }
//
//
//        /*
//         * 考取所有的js文件
//         * (?<=<script src=\")[^\"]*
//         */
//        preg_match_all("/(?<=<script src=\")[^\"]*/",$tarData,$matches);
//        foreach($matches[0] as $jsFile){
//
//            $cssOldFile = $tarDir."/".$jsFile;
//            $newFile = $workDir."/".$jsFile;
//            copToMulDirFile($cssOldFile,$newFile);
//        }
//
//
//        /*
//         *将资源文件分门别类
//         */
//
//        moveFiles();
//
//    }
?>
<html>
<head>
    <title>主页</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/index.css"/>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body style="padding-top:50px">

<h3>移动页面的所有css和js到目标目录的相应文件夹下，并处理css文件的url路径问题</h3>
<hr/>
<form role="form" class="form-horizontal" method="post" action="dealHtmlpro.php?action=deal">
    <div class="form-group">
        <label for="tarPage" class="col-sm-2 control-label">目标网页：</label>

        <div class="col-sm-6">
            <input type="text" name="tarPage" class="form-control" id="tarPage" placeholder="tarPage">
        </div>
    </div>

    <div class="form-group">
        <label for="workDir" class="col-sm-2 control-label">移动到的目录：</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" name="workDir" id="workDir" placeholder="workDir">
        </div>
        <input type="submit" class="btn btn-success" value="处理"/>
    </div>
</form>
<hr/>

</body>
</html>