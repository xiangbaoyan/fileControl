<?php
    define("IN_TG",true);
    require $_SERVER['DOCUMENT_ROOT']."/functions/commonFun.php";
    require BASE_DIR."/functions/mysqlFun.php";

    //创建用户表,首先写明字段，
    $arr = ['username','password','uniqid','active','sex','level','reg_time',
        'last_time','login_ip','login_count'];
    //创建网站模块表
    $html = ['title','slogan'];

    _connect();
    creDataBase();
    _select_db();
    _set_names();
    creUserTable($arr);
    creHtmlTable($html);
    _close();


