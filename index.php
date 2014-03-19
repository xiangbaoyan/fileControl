<!DOCTYPE html>
<?php
require __DIR__ . "/functions/common.php";
require __DIR__ . "/functions/disDeFold.php";
$con = parse_ini_file("config.ini");
if (!@$con['proName']) {
    echo "配置为空";
    die;
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
<body>
<div class="panel-group" id="accordion">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion"
           href="#collapseOne"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    列出所有API，查看说明
                </h4>
            </div>
        </a>

        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="col-md-7">
                    <?php
                    $it = new DirectoryIterator(BASE_DIR . "/functions");
                    foreach ($it as $api) {
                        if (!$it->isDot()) {
                            ?>
                            <form class="form1" action="/actions/modIniParaA.php" method="post">
                                <input name="paraName" type="hidden" value="<?php echo $api ?>"/>
                                <label class="labelC" for="<?php echo $api ?>"><?php echo $api ?>:</label>
                                <input style="width:500px"
                                       type="text" id="<?php echo $api ?>" name="paraValue"
                                       value="<?php if (@$con["{$api}"]) {
                                           echo @$con["{$api}"];
                                       } ?>"/>
                                <input type="submit" value="修改"/>
                            </form>
                            <br>
                            <br>
                        <?php
                        }
                    }
                    ?>
                </div>
                <div
                <div class="col-md-5">
                    <h4>actions:</h4>
                    <hr>
                    <?php
                    $it = new DirectoryIterator(BASE_DIR . "/actions");
                    foreach ($it as $api) {
                        if (!$it->isDot()) {
                            ?>
                            <form class="form1" action="/actions/modIniParaA.php" method="post">
                                <input name="paraName" type="hidden" value="<?php echo $api ?>"/>
                                <label class="labelC" for="<?php echo $api ?>"><?php echo $api ?>:</label>
                                <input style="width:400px"
                                       type="text" id="<?php echo $api ?>" name="paraValue"
                                       value="<?php if (@$con["{$api}"]) {
                                           echo @$con["{$api}"];
                                       } ?>"/>
                                <input type="submit" value="修改"/>
                            </form>
                            <br>
                            <br>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<form action="/actions/modIniParaA.php" method="post" class="form1">
    <label for="proName">项目目录:</label>
    <input type="text" id="proName" name="paraValue" value="<?php echo $con['proName'] ?>"/>
    <input type="submit" value="修改目录"/>
</form>

<form action="/actions/listDirFilesA.php" class="form1">
    <input id="list" type="submit" value="列出所有文件"/>
</form>
<form action="/actions/updIniA.php" class="form1">
    <input id="list" type="submit" value="更新所有的ini文件"/>
</form>

<hr>
<form action="/actions/moveFilesA.php" method="post" class="form2">
    <label for="proDir">移动并整理所有文件到目录:</label>
    <input type="text" name="proDir" id="proDir" value="<?php echo $con['proDir'] ?>"
           style="width:300px"/>
    <input type="submit" value="处理"/>
    <a href="/actions/modSimResA.php" class="btn btn-primary" role="button">
        <i class="glyphicon glyphicon-plus"></i>
        针对这个目录来进行对css文件不改名的简单处理</a>
</form>
<hr>

<!--整理HTML生成的php文件-->
<form action="/actions/modHtmlA.php" method="post">
    <label>修改所有HTML生成的php文件(这是对复杂名称的css文件进行改名处理):</label>
    <input type="text" name="proDir" id="proDir" style="width: 500px" value="<?php echo $con['proDir'] ?>">
    <input type="submit" value="处理"/>
</form>

<hr>
<form action="/actions/crePageDirA.php" method="post">
    <label for="proDir2">提取一个页面相关数据到一个新的目录(后缀是page2)：</label>
    <input type="text" name="proDir2" id="proDir2" readonly style="width: 500px"
           value="<?php echo $con['proDir'] . "-page2" ?>">
    <br>
    <label for="page" style="margin-left: 200px">要截取的页面为：</label>
    <input type="text" name="page" style="width:500px" id="page" value="<?php echo $con['proDir'] ?>"/>
    <input type="submit" class="btn btn-success" value="处理"/>
</form>


<hr>

<!--整理所有的css文件-->
<form action="/actions/modCssA.php" method="post">
    <label>整理所有的css文件(修改背景图片的路径，去除注释,多余的charset):</label>
    <input type="submit" value="处理"/>
</form>

<hr>
<h3 style="display: inline-block">=========解刨网页留作模板===========</h3>
<a href="/lib/simplehtmldom_1_5/manual/manual.htm" class="btn btn-success" role="button" target="_blank">
    <i class="glyphicon glyphicon-plus"></i>
    打开simpleHtmlDom的帮助文档</a>

<a href="store.php" class="btn btn-success" style="" role="button"> 查看储存的模板</a>
<a href="phpinfo.php" class="btn btn-primary" role="button" target="_blank">打开phpinfo</a>
<a href="peek.php" class="btn btn-success" style="margin-left: 150px" role="button" target="_blank"> 预览模板</a>
<a href="/actions/clearPeekmodsA.php" class="btn btn-danger" role="button">清空所有模板</a>
<hr>
<?php
disDeFold("拆解标题Title")
?>


<hr>
<h1>=====为finalPro项目压缩css=====</h1>

<div class="row">
    <form action="/actions/compressCssA.php" class="form-horizontal" method="post">
        <div class="form-group">
            <label for="proName" class="col-sm-3 control-label">压缩CSS:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" id="proName" name="proName"
                       value="<?php echo str_replace(basename($con['proDir']), "finalPro", $con['proDir']); ?>">
            </div>
            <input id="list" class="btn btn-success col-sm-3" type="submit" value="开始压缩"/>
        </div>
    </form>
</div>
<div class="row">
    <form action="/actions/deCompAndBeaA.php" class="form-horizontal" method="post">
        <div class="form-group">
            <label for="proName" class="col-sm-3 control-label">解压缩并美化:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" id="proName" name="proName"
                       value="<?php echo str_replace(basename($con['proDir']), "finalPro", $con['proDir']); ?>">
            </div>
            <input id="list" class="btn btn-success col-sm-3" type="submit" value="开始解压美化"/>
        </div>
    </form>
</div>

<hr>
<h1>========添加辅助功能：=========</h1>


<hr>
<div class="row">
    <div class="form-group">
        <form action="/actions/addBsSupA.php" class="form-horizontal" method="post">

            <label for="proName" class="col-sm-3 control-label">请输入要添加的项目路径:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" id="proName" name="proName"
                       value="<?php echo str_replace(basename($con['proDir']), "finalPro", $con['proDir']); ?>">
            </div>
            <input id="list" class="btn btn-success col-sm-2" type="submit" value="为该项目添加Bootstrap支持"/>

        </form>
    </div>
    <div class="form-group">
        <form action="/actions/addAdminA.php" method="post" class="form-horizontal">
            <label for="proName3d" class="col-sm-3 control-label">请输入要添加的项目路径:</label>

            <div class="col-sm-4">
                <input type="text" name="proName" id="proName3" class="form-control"
                       value="<?php echo str_replace(basename($con['proDir']), "finalPro", $con['proDir']); ?>"/>
            </div>
            <input type="submit" class="btn btn-success col-sm-1" style="margin-left: 30px" value="添加后台支持"/>
        </form>
    </div>
</div>

<div class="row">
    <form action="/actions/addJqueryToProA.php" class="form-horizontal" method="post">
        <div class="form-group">
            <label for="proName" class="col-sm-3 control-label">请输入要添加的项目路径:</label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="jquerySupport" name="proName"
                       value="<?php echo str_replace(basename($con['proDir']), "finalPro", $con['proDir']); ?>">
            </div>

            <input class="btn btn-danger col-sm-3" type="submit" value="（必须先填）为该项目添加Jquery支持(可以为页面添加)"/>
        </div>
    </form>
</div>


<div class="panel-group" id="accordion2">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion2"
           href="#collapse2"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    列出所有js函数，选择并合并加入页面;
                </h4>
            </div>
        </a>

        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <?php
                $jsCon = parse_ini_file(BASE_DIR . "/js.ini");
                $it = new DirectoryIterator(BASE_DIR . "/resource/jsfunctions");
                foreach ($it as $api) {
                    if (!$it->isDot()) {
                        ?>
                        <form class="form-horizontal" action="/actions/modIniParaA.php" method="post">
                            <div class="col-sm-8">
                                <input name="paraName" type="hidden" value="<?php echo $api ?>"/>
                                <label class="labelC" for="<?php echo $api ?>"><?php echo $api ?>:</label>
                                <input style="width:500px"
                                       type="text" id="<?php echo $api ?>" name="paraValue"
                                       value="<?php if (@$jsCon["{$api}"]) {
                                           echo @$jsCon["{$api}"];
                                       } ?>"/>
                                <input type="submit" value="修改"/>
                                <label for="jses" style="margin-left: 100px" class="control-label">选择此js:</label>
                            </div>

                            <div class="col-sm-1">
                                <input style="height: 30px" type="checkbox" name="jses" value="<?php echo $api ?>"
                                       class="form-control" id="jses"/>
                            </div>
                            <hr>
                        </form>

                        <br>
                        <br>
                    <?php
                    }
                }
                ?>

                <div class="form-group">
                    <label class="control-label col-sm-1" for="finalPro">目标网页</label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="finalPro"/>
                    </div>
                    <button class="btn btn-success col-sm-3" id="addJsBtn">
                        <i class="glyphicon glyphicon-plus"></i>
                        添加到目标项目的网页中去
                    </button>
                </div>

            </div>
        </div>


    </div>
</div>


<div class="panel-group" id="accordion3">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion3"
           href="#collapse3"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    列出所有要为项目添加的php功能(比如说验证码)
                </h4>
            </div>
        </a>

        <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
                <?php
                $phpCon = parse_ini_file(BASE_DIR . "/php.ini");
                $it = new DirectoryIterator(BASE_DIR . "/resource/phpFunctions");
                foreach ($it as $api) {
                    if (!$it->isDot()) {
                        ?>
                        <form class="form-horizontal" action="/actions/modIniParaA.php" method="post">
                            <div class="col-sm-8">
                                <input name="paraName" type="hidden" value="<?php echo $api ?>"/>
                                <label class="labelC" for="<?php echo $api ?>"><?php echo $api ?>:</label>
                                <input style="width:490px"
                                       type="text" id="<?php echo $api ?>" name="paraValue"
                                       value="<?php if (@$phpCon["{$api}"]) {
                                           echo @$phpCon["{$api}"];
                                       } ?>"/>
                                <input type="submit" value="修改"/>
                                <label for="phpes" style="margin-left: 100px" class="control-label">选择phpFun:</label>
                            </div>

                            <div class="col-sm-1">
                                <input style="height: 30px" type="checkbox" name="phpes" value="<?php echo $api ?>"
                                       class="form-control" id="phpes"/>
                            </div>
                            <hr>
                        </form>

                        <br>
                        <br>
                    <?php
                    }
                }
                ?>
                <div class="row" style="text-align: center">
                    <?php
                    $arr = scandir(BASE_DIR . "/resource/codeSeg");
                    $codeSegArr = parse_ini_file(BASE_DIR . "/codeSeg.ini");
                    foreach ($arr as $value) {
                        if ($value != "." && $value != "..") {

                            $chanShu = isset($codeSegArr[$value]) ? $codeSegArr[$value] : "";

                            echo " <div class='row'><label for=\"hello\" class=\"control-label col-sm-2\">{$value}</label>";
                            echo "

                                <form action='/actions/modIniParaA.php' method='post'>
                                     <input type='hidden' name='paraName' value='{$value}'/>
                                     <div class='col-sm-3'>
                                        <input type='text' name='paraValue' id='cText' class='form-control'

                                        value='{$chanShu}'/>
                                    </div>
                                    <div class='col-sm-1'>
                                    <input type='submit' class='btn btn-success' value='提交修改参数'/>
                                    </div>
                                </form>
                                <div class=\" col-sm-1\">
                                    <input type=\"checkbox\" name=\"codeSeg\" value=\"{$value}\" id=\"hello\" class=\"form-control\"/>
                                </div>
                                </div>
                                <hr>
                                ";


                        }
                    }
                    ?>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-1" for="finalPro2">目标网页</label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="finalPro2" name="proName">
                    </div>
                    <button class="btn btn-success col-sm-3" id="addPhpBtn">
                        <i class="glyphicon glyphicon-plus"></i>
                        添加到目标项目的网页中去
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-group" id="accordion5">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion5"
           href="#collapse5"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    MYSQL备注的记忆选项
                </h4>
            </div>
        </a>

        <div id="collapse5" class="panel-collapse collapse">
            <div class="panel-body">
             <?php include "MYSQL.php"?>
            </div>
        </div>
    </div>
</div>

<div class="panel-group" id="accordion6">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion6"
           href="#collapse6"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                   针对单个文件处理的选项集合
                </h4>
            </div>
        </a>

        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <?php include("dealSinglePage.php")?>
            </div>
        </div>
    </div>
</div>
<?php  include_once "smartyTool.php"?>
<hr>
<div id="helloTest"></div>
</body>
<script type="text/javascript">
    $("#jquerySupport").bind("keyup paste change", function () {
        $("#finalPro").val($("#jquerySupport").val());
        $("#finalPro2").val($("#jquerySupport").val());
    });


    $("#addJsBtn").click(function () {
        var arr = [];
        var page = $("#finalPro").val();
        $("input[name='jses']:checked").each(function () {
            arr.push($(this).val());
        });
        $.post("/actions/addJsesA.php", {jses: arr, pageName: page}, function (data) {
            $("#helloTest").html(data);
        });
    });

    $("#addPhpBtn").click(function () {
        var arr = [];
        var codeArr = [];
        var dir = $("#finalPro2").val();
        $("input[name='phpes']:checked").each(function () {
            arr.push($(this).val());
        });
        $("input[name='codeSeg']:checked").each(function () {
            codeArr.push($(this).val());
        });
        $.post("/actions/addPhpesA.php", {phpes: arr, proPage: dir, codeSegs: codeArr}, function (data) {
            $("#helloTest").html(data);
        });
    });
</script>
</html>