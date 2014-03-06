<?php
//防止恶意调用
//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','');
define('DB_NAME','t_g');

if (!defined('IN_TG')) {
    exit('Access Defined!');
}

/**
 * _connect() 连接MYSQL数据库
 * @access public
 * @return void
 */

function _connect() {
    //global 表示全局变量的意思，意图是将此变量在函数外部也能访问
    global $_conn;
    if (!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD)) {
        exit('数据库连接失败');
    }
}

/**
 * _select_db选择一款数据库
 * @return void
 */

function _select_db() {
    if (!mysql_select_db(DB_NAME)) {
        exit('找不到指定的数据库');
    }
}

/**
 *
 */

function _set_names() {
    if (!mysql_query('SET NAMES UTF8')) {
        exit('字符集错误');
    }
}

/**
 *
 * @param $_sql
 */

function _query($_sql) {
    if (!$_result = mysql_query($_sql)) {
        exit('SQL执行失败'.mysql_error());
    }
    return $_result;
}

/**
 * _fetch_array只能获取指定数据集一条数据组
 * @param $_sql
 */

function _fetch_array($_sql) {
    return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/**
 * _fetch_array_list可以返回指定数据集的所有数据
 * @param $_result
 */

function _fetch_array_list($_result) {
    return mysql_fetch_array($_result,MYSQL_ASSOC);
}

function _num_rows($_result) {
    return mysql_num_rows($_result);
}


/**
 * _affected_rows表示影响到的记录数
 */

function _affected_rows() {
    return mysql_affected_rows();
}

/**
 * _free_result销毁结果集
 * @param $_result
 */

function _free_result($_result) {
    mysql_free_result($_result);
}

/**
 * _insert_id
 */

function _insert_id() {
    return mysql_insert_id();
}

/**
 *
 * @param $_sql
 * @param $_info
 */

function _is_repeat($_sql,$_info) {
    if (_fetch_array($_sql)) {
        _alert_back($_info);
    }
}


function _close() {
    if (!mysql_close()) {
        exit('关闭异常');
    }
}

/*
 * CREATE TABLE `tg_user` (
  `tg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//用户自动编号'
,
  `tg_uniqid` char(40) NOT NULL COMMENT '//验证身份的唯一标识符'
,
  `tg_active` char(40) NOT NULL COMMENT '//激活登录用户'
,
  `tg_username` varchar(20) NOT NULL COMMENT '//用户名'
,
  `tg_password` char(40) NOT NULL COMMENT '//密码'
,
  `tg_question` varchar(20) NOT NULL COMMENT '//密码提示'
,
  `tg_answer` char(40) NOT NULL COMMENT '//密码回答'
,
  `tg_email` varchar(40) default NULL COMMENT '//邮件'
,
  `tg_qq` varchar(10) default NULL COMMENT '//QQ'
,
  `tg_url` varchar(40) default NULL COMMENT '//网址'
,
  `tg_sex` char(1) NOT NULL COMMENT '//性别'
,
  `tg_face` char(12) NOT NULL COMMENT '//头像'
,
  `tg_switch` tinyint(1) unsigned NOT NULL default '0' COMMENT '//个性签名开关'
,
  `tg_autograph` varchar(200) default NULL COMMENT '//签名内容'
,
  `tg_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//会员等级'
,
  `tg_post_time` varchar(20) NOT NULL default '0' COMMENT '//发帖的时间戳'
,
  `tg_article_time` varchar(20) NOT NULL default '0' COMMENT '//回帖的时间戳'
,
  `tg_reg_time` datetime NOT NULL COMMENT '//注册时间'
,
  `tg_last_time` datetime NOT NULL COMMENT '//最后登录的时间'
,
  `tg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录的IP'
,
  `tg_login_count` smallint(4) unsigned NOT NULL default '0' COMMENT '//登录次数'
,
  PRIMARY KEY  (`tg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

 */
/*--------------------------初始化函数------------------------------*/
//    $arr = ['username','password','uniqid','active','sex','level','reg_time',
//  'last_time','last_ip','login_count'];
function creDataBase(){
    echo "1";
    $sql = "CREATE DATABASE IF NOT EXISTS `t_g` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
    _query($sql);
    echo "2";
}
/*
 * ============   创建表   =====================
 */
function creUserTable($arr){
    echo "3";
    $sql = "CREATE TABLE IF NOT EXISTS `tg_user` (
           `tg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//用户自动编号'
           ";

    if(in_array("username",$arr)){

    $sql.= ",`tg_username` varchar(20) NOT NULL COMMENT '//用户名'";

    }

    if(in_array("password",$arr)){
    $sql .= ",`tg_password` char(40) NOT NULL COMMENT '//密码'";
    }

    if(in_array("uniqid",$arr)){
    $sql.= ",`tg_uniqid` char(40) NOT NULL COMMENT '//验证身份的唯一标识符'";
    }

    if(in_array("active",$arr)){
    $sql.=",`tg_active` char(40) NOT NULL COMMENT '//激活登录用户'";
    }

    if(in_array("sex",$arr)){
    $sql.=",`tg_sex` char(1) NOT NULL COMMENT '//性别'";
    }

    if(in_array("level",$arr)){
    $sql.=",`tg_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//会员等级'";
    }

    if(in_array("reg_time",$arr)){
    $sql.=",`tg_reg_time` datetime NOT NULL COMMENT '//注册时间'";
    }

    if(in_array("last_time",$arr)){
    $sql.=",`tg_last_time` datetime NOT NULL COMMENT '//最后登录的时间'";
    }


    if(in_array("login_count",$arr)){
    $sql.=",`tg_login_count` smallint(4) unsigned NOT NULL default '0' COMMENT '//登录次数'";
    }

    if(in_array("login_ip",$arr)){
    $sql.=",`tg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录的IP'";
    }

    /*
     * 结束$sql
     */
    $sql.=",PRIMARY KEY  (`tg_id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;";
    _query($sql);
    echo "4";
}

function creHtmlTable($arr){
    $sql = "CREATE TABLE IF NOT EXISTS `tg_html` (
           `tg_id` mediumint(8) unsigned NOT NULL COMMENT '//用户自动编号'
           ";

    if(in_array("title",$arr)){

        $sql.= ",`tg_title` varchar(20) NOT NULL COMMENT '//网站标题'";

    }

    if(in_array("slogan",$arr)){

        $sql.= ",`tg_slogan` varchar(40) NOT NULL DEFAULT '努力进取，团结奋进' COMMENT '//网站标题'";

    }

    $sql.=",PRIMARY KEY  (`tg_id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;";
    _query($sql);
}


/*--------------------------注册函数-------------------------------*/
/*
 * 	"INSERT INTO tg_user (
																tg_uniqid,
																tg_active,
																tg_username,
																tg_password,
																tg_question,
																tg_answer,
																tg_sex,
																tg_face,
																tg_email,
																tg_qq,
																tg_url,
																tg_reg_time,
																tg_last_time,
																tg_last_ip
																)
												VALUES (
																'{$_clean['uniqid']}',
																'{$_clean['active']}',
																'{$_clean['username']}',
																'{$_clean['password']}',
																'{$_clean['question']}',
																'{$_clean['answer']}',
																'{$_clean['sex']}',
																'{$_clean['face']}',
																'{$_clean['email']}',
																'{$_clean['qq']}',
																'{$_clean['url']}',
																NOW(),
																NOW(),
																'{$_SERVER["REMOTE_ADDR"]}'
																)"
 */

function changeToVar($arrSin){
    return "'".$arrSin."'";
}
function changeToTab($arrSin){
    return "tg_".$arrSin;
}
function registUser($arr) {

    $arrC = array_map("changeToVar",$arr);
    $cleanNames = implode(",",$arrC);

    $arr2 = array_keys($arr);
    $arrTg = array_map("changeToTab",$arr2);
    $tgNames = implode(",",$arrTg);

    //插入注册时间
    $tgNames .= ",tg_reg_time";
    $cleanNames .= ",NOW()";
    $sql = "INSERT INTO tg_user (".$tgNames.") VALUES (".$cleanNames.");";
    _is_repeat(
        "SELECT tg_username FROM tg_user WHERE tg_username='{$arr['username']}' LIMIT 1",
        '对不起，此用户已被注册'
    );
    _query($sql);
    backPage("注册成功");
}


function loginUser($arr){
    if   (!!$_rows = _fetch_array("SELECT tg_username,tg_uniqid,tg_level
    FROM tg_user WHERE tg_username='{$arr['username']}' AND tg_password='{$arr['password']}'"))
    //登陆成功后，记录登陆信息
    {
        _query("UPDATE tg_user SET
															tg_last_time=NOW(),
															tg_last_ip='{$_SERVER["REMOTE_ADDR"]}',
															tg_login_count=tg_login_count+1
												WHERE
															tg_username='{$_rows['tg_username']}'
													");
    //设置保留时间
    _setcookies($_rows['tg_username'],$_rows['tg_uniqid'],'2');
    //看是否是admin
        if ($_rows['tg_level'] == 1) {
            $_SESSION['admin'] = $_rows['tg_username'];
            _close();
            backPage(null);
            }
        backPage("登陆成功");
    }
    else {
    _close();
    //_session_destroy();
    backPage('用户名密码不正确或者该账户未被激活！','muser-login.php');
    }
}

