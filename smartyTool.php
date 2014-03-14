<?php
    $projectName = @$_POST['projectName'];
    if($projectName){
        require $_SERVER['DOCUMENT_ROOT']."/functions/common.php";
        require $_SERVER['DOCUMENT_ROOT']."/functions/copDirToDir.php";
        $desDir = dirname($_SERVER['DOCUMENT_ROOT']);
        $sourDir = $_SERVER['DOCUMENT_ROOT']."/resource/smarty/project";
        copDirToDir($desDir,$sourDir,$projectName);
        popWin("成功创建项目");
    }
?>
<div class="panel-group" id="accordion6">
    <div class="panel">
        <a data-toggle="collapse" data-parent="#accordion6"
           href="#collapse6"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    smarty工具
                </h4>
            </div>
        </a>
        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <form role="form" action="smartyTool.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="creSmartyPro">创建smarty项目:</label>
                        <div class="col-md-5">
                            <input type="text" name="projectName" class="form-control" id="creSmartyPro" placeholder="输入要创建的项目名">
                        </div>
                        <button type="submit" class="btn btn-default">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>