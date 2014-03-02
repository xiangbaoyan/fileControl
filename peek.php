
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

<form role="form" class="form-horizontal" method="post" action="/actions/comModsA.php">
    <div class="form-group">
        <label for="nums" class="col-sm-2 control-label">请输入组合顺序:</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="nums" name="nums" placeholder="输入.....">
         </div>

        <label for="pageName" class="col-sm-3 control-label">指定次页面的名称(不要输入后缀名):</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="pageName" name="pageName" placeholder="可以输入index">
        </div>
    </div>
      <div class="form-group">
<!--          <label for="projectName" class="col-sm-2 control-label">选择项目:</label>-->
<!--          <div class="col-sm-2">-->
<!---->
<!--              <select name="projectName" class="form-control" id="projectName">-->
<!--                  --><?php
//                  $it = new DirectoryIterator($_SERVER['DOCUMENT_ROOT']."/projects");
//                  foreach($it as $file){
//                      if(!$it->isDot()){
//                          echo "<option value=\"{$file}\">{$file}</option>";
//                      }
//                  }
//                  ?>
<!--                  <option value="">==新建==</option>-->
<!--              </select>-->
<!--          </div>-->
          <div class="col-sm-1" style="margin-left: 50px">
              <a href="/actions/clearFinalProA.php" class="btn btn-danger" role="button">
              清空目标项目finalPro</a>
          </div>

          <div class="col-sm-1" style="margin-left: 600px">
              <input type="submit" class="btn btn-success" value="提交"/>
          </div>
          <div class="col-sm-1">
              <a href="/store.php" class="btn btn-primary" role="button">
                  <i class="glyphicon glyphicon-plus"></i>
                  添加一个储藏室的模块</a>
          </div>

          <div class="col-sm-1" style="margin-left: 100px">
              <a href="/actions/clearPeekmodsA.php" class="btn btn-danger" role="button">
                  清空所有模板</a>
          </div>
      </div>



</form>
<hr>
<?php

/**
 * 预览网页
 */
require "functions/common.php";

//select 里面的选项遍历出来
$arr = scandir(BASE_DIR."/resource/modules");
array_shift($arr);
array_shift($arr);

$it = new RecursiveDirectoryIterator(BASE_DIR."/modules");
foreach(new RecursiveIteratorIterator($it) as $file){
    if(strpos($file,".php")>-1){


        $file = str_replace("\\","/",$file);

        $path =  preg_replace("/.*(?=\/modules)/","",$file);

        ?>


        <iframe src="<?php echo $path ?>" frameborder="0" style="height:auto;" width=1000>
        </iframe>

        <form action="/actions/storeModDivA.php" method="post">
                <label for="addrFile"><?php echo $file?></label>
                <input type="hidden" name="addrFile" id="addrFile" value="<?php echo $file?>"/>

                <label for="divName">输入要存放的目录名：</label>
                <input type="text" id="divName" name="divName" placeholder="name">

                <label for="cate">选择要储存的目录:</label>

                <select name="cate" id="cate">
                    <option value="">==请选择目录==</option>
                    <?php foreach($arr as $value){
                        echo "<option value='{$value}'>{$value}</option>";
                    }
                    ?>

                </select>
                <div class="pull-right" style="margin-right: 80px">
                    <input type="submit"  class="btn btn-primary" value="储存起来"/>
                    <a href="/actions/delThisModFromPeekA.php?name=<?php echo $file?>" class="btn btn-primary" role="button">
                        移除此模块</a>
                </div>

            </form>
        <hr>
    <?php
    }
}
?>
</body>
</html>
