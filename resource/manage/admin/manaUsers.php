<div style="margin-top: 50px">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="../admin.php">
                后台主页
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="fa fa-edit"></i>
            <a href="#">
                用户管理
            </a>
        </li>
    </ul>
     
    <ul class="pagination" >
        <li><a id="lastTen"><i class="fa fa-arrow-left"></i>上十页</a></li>
        <li><a id="lastOne"><i class="fa fa-arrow-left"></i>上一页</a></li>
        <?php
        define("IN_TG", true);
        require $_SERVER['DOCUMENT_ROOT'] . "/functions/mysqlFun.php";
        _connect();
        _select_db();
        _set_names();
        //确定总数是多少
        $sql = "select count(tg_id) pageSum from tg_user";
        $row = _fetch_array($sql);
        $pageSum = $row['pageSum'];
        $pageSum = ceil($pageSum/5);
        //存放在cookie
        //现在确定一次显示10页，每页5条
        foreach (range(1, $pageSum) as $value) {
            ?>
            <li class="liNum" style="display:none;" mytag="<?php echo $value ?>">
                <a><?php echo $value ?></a></li>
            <?php
        }
        //查询指定数目的记录
        ?>
        <li><a id="nextOne">下一页<i class="fa fa-arrow-right"></i></a></li>
        <li><a id="nextTen">下十页<i class="fa fa-arrow-right"></i></a></li>
    </ul>
<div id="showUsers">
</div>
<script src="js/myPagify.js"></script>

