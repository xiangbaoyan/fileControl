<?php
    if(@$_GET['action']=='deal'){
        require $_SERVER['DOCUMENT_ROOT']."/functions/common.php";
        require $_SERVER['DOCUMENT_ROOT']."/functions/copToMulDirFile.php";
        $tarPage = @$_POST['tarPage'];
        $workDir = @$_POST['workDir'];
        $tarDir = dirname($tarPage);
        $tarData = file_get_contents($tarPage);
        preg_match_all("/(?<=<link href=\")[^\"]*/",$tarData,$matches);

        /*
         * 拷贝这个页面过去
         */
        copToMulDirFile($tarPage,$workDir."/".basename($tarPage));

        /*
         * 考取所有css文件
         */
        //这里默认截取到的css路径是相对路径例如 media/fun
        foreach($matches[0] as $cssFile){

            $cssOldFile = $tarDir."/".$cssFile;
            //找到cssData 里的图片考取图片
            $cssData = file_get_contents($cssOldFile);
            preg_match_all("/(?<=url\()[^\)]*/",$cssData,$preArr);
            foreach($preArr[0] as $imgPath){
                $imgPathOld = preg_replace("/\.{2}/",$tarDir."/media",$imgPath);
                $newPath = $workDir.preg_replace("/\.{2}/","",$imgPath)."<br>";
                if(is_file($imgPathOld)){
                   copToMulDirFile($imgPathOld,$newPath);
                }
            }


            $newFile = $workDir."/".$cssFile;
            copToMulDirFile($cssOldFile,$newFile);
        }


        /*
         * 考取所有的js文件
         * (?<=<script src=\")[^\"]*
         */
        preg_match_all("/(?<=<script src=\")[^\"]*/",$tarData,$matches);
        foreach($matches[0] as $jsFile){

            $cssOldFile = $tarDir."/".$jsFile;
            $newFile = $workDir."/".$jsFile;
            copToMulDirFile($cssOldFile,$newFile);
        }


        /*
         *
         */
    }
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