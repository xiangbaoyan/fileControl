
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
<body>
<?php

/**
 * 预览网页
 */
require "functions/common.php";


$it = new RecursiveDirectoryIterator(BASE_DIR."/resource/modules");
foreach(new RecursiveIteratorIterator($it) as $file){
    if(strpos($file,".php")>-1){

        //echo $file;

        //替换路径;

        $file = str_replace("\\","/",$file);

        $path =  preg_replace("/.*(?=\/resource)/","",$file);
        ?>


        <iframe src="<?php echo $path ?>" frameborder="0" width=1000></iframe>
        <form action="/actions/addToNowProA.php" class="form-horizontal" method="post">
        <div class="row">
          <label for="divName" class="col-sm-2 control-label">存放地址:</label>
           <div class="col-sm-5">
            <span><?php echo $file?><span>
            <input type="hidden" class="form-control" name="mod" readonly value="<?php echo $file?>">
          </div>

            <input type="submit" class="btn btn-success" style="margin-left: 20px" value="将模块添加到当前工程"/>
            <input type="text" name="divName" id="divName" value="div1" placeholder="填写新添加的名称"/>
        </div>
       </form>

        <hr>
    <?php
    }
}
?>
</body>
</html>
