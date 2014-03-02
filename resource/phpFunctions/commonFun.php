<?php

if(!defined("IN_TG")){
    exit("访问拒绝");
}

/**
 * commonFun.php
 * 公共文件
 * 包含了对项目根目录的处理 BASE_DIR
 *
 */

/*
 * 示例:
 * C:\Users\Administrator\Desktop\fileControl
 */
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
//创建一个自动转义状态的常量
define('GPC',get_magic_quotes_gpc());


//开启session
session_start();
//拒绝PHP低版本
if (PHP_VERSION < '4.1.0') {
    exit('Version is to Low!');
}

//以下是重要函数
/**
 * _mysql_string
 * @param string $_string
 * @return string $_string
 */

function _mysql_string($_string) {
    //get_magic_quotes_gpc()如果开启状态，那么就不需要转义
    if (!GPC) {
        if (is_array($_string)) {
            foreach ($_string as $_key => $_value) {
                $_string[$_key] = _mysql_string($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
            }
        } else {
            $_string = mysql_real_escape_string($_string);
        }
    }
    return $_string;
}


//生成唯一码
function _sha1_uniqid() {
    return _mysql_string(sha1(uniqid(rand(),true)));
}


//退回关闭
function _alert_back($_info) {
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}


function _alert_close($_info) {
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

function backPage($info,$page=""){
    $url = "http://".$_SERVER['SERVER_NAME']."/{$page}";
    if($info){
        echo "<script>alert('".$info."')</script>;";
    }
    echo "<script>location.href='".$url."'</script>";
}


/**
 * _setcookies生成登录cookies
 * @param unknown_type $_username
 * @param unknown_type $_uniqid
 */


function _setcookies($_username,$_uniqid,$_time) {
    switch ($_time) {
        case '0':  //浏览器进程
            setcookie('username',$_username);
            setcookie('uniqid',$_uniqid);
            break;
        case '1':  //一天
            setcookie('username',$_username,time()+86400);
            setcookie('uniqid',$_uniqid,time()+86400);
            break;
        case '2':  //一周
            setcookie('username',$_username,time()+604800);
            setcookie('uniqid',$_uniqid,time()+604800);
            break;
        case '3':  //一月
            setcookie('username',$_username,time()+2592000);
            setcookie('uniqid',$_uniqid,time()+2592000);
            break;
    }
}