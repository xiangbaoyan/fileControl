<?php
if (defined("IN_ADMIN")) {
    exit("网站访问被拒绝");
}
define("IN_TG", true);
require $_SERVER['DOCUMENT_ROOT'] . "/functions/mysqlFun.php";
_connect();
_select_db();
_set_names();
$sql = "select tg_title,tg_slogan from tg_html where tg_id = 1";
$row = _fetch_array($sql);
_close();

?>

<div style="margin-top: 50px">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="admin.php">
                后台主页
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="fa fa-edit"></i>
            <a href="#">
                主页内容
            </a>
        </li>
    </ul>
    <div class="form form-horizontal">
        <div class="form-group">
            <label for="title" class="control-label col-md-2">主页标题:</label>
            <div class="col-md-7">
                <input type="text" id="title" name="title" class="form-control"
                    value="<?php echo $row['tg_title']?>">
            </div>
            <span class="help-inline">五个字效果最佳</span>
            <button style="margin-left: 30px" class="btn blue">提交</button>
        </div>
        <div class="form-group">
            <label for="slogan" class="control-label col-md-2">标语:</label>
            <div class="col-md-7">
                <input type="text" id="slogan" name="slogan" class="form-control"
                       value="<?php echo $row['tg_slogan']?>">
            </div>
            <span class="help-inline">六个字效果最佳</span>
            <button style="margin-left: 30px" class="btn blue">提交</button>
        </div>
    </div>


</div>

<script>
    $('div .form button').click(function () {
        var name = $(this).parent().find("input").attr("name");
        var con = $(this).parent().find("input").val();
        $.post("/activePage/m.php", {name: name, con: con}, function () {
            alert("保存成功");
        })
    });
</script>