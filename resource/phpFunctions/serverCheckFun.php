<?php
if(!defined("IN_TG")){
    exit("访问拒绝");
}
//定义一个错误变量
$errData = "";

/**
 * 对每个post进来的数据进行验证，然后放在一个数组返回
 *
 * @param array $arr 例如["username"]
 *
 * @return array
 */

function serverCheckFun($arr){
    global $errData;
    $clean = [];
        if(in_array("code",$arr)){
            _check_code(@$_POST['captcha'],$_SESSION['code']);
        }
        if(in_array("username",$arr)){
            $clean['username']= _check_username(@$_POST['username'],6,20);
        }

        if(in_array("password",$arr)){
            $clean['password']= _check_password(@$_POST['password'],6,40);
        }

        if(in_array("repassword",$arr)){
           _check_repassword(@$_POST['password'],@$_POST['repassword']);
        }

        if(in_array("repassword",$arr)){
            _check_password(@$_POST['password'],6,40);
        }

        if(in_array("uniqid",$arr)){
           $clean['uniqid'] = _check_uniqid(@$_POST['uniqid'],$_SESSION['uniqid']);
        }
        return $clean;
    }


//问题是用什么来显示出错信息，可以用一个变量来存然后在页面echo;

/**
 * _check_username表示检测并过滤用户名
 * @access public
 * @param string $_string 受污染的用户名
 * @param int $_min_num  最小位数
 * @param int $_max_num 最大位数
 * @return string  过滤后的用户名
 */
function _check_username($_string,$_min_num,$_max_num) {
    global $errData;
    //去掉两边的空格
    $_string = trim($_string);

    //长度小于两位或者大于20位
    if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num) {
         $errData .= '用户名长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位'."<br>";

    }

    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \　]/';
    if (preg_match($_char_pattern,$_string)) {
        $errData .= '用户名不得包含敏感字符'."<br>";
    }

    //将用户名转义输入
    return _mysql_string($_string);
}


/**
 * _check_password验证密码
 * @access public
 * @param string $_first_pass
 * @param int $_min_num
 * @return string $_first_pass 返回一个加密后的密码
 */

function _check_password($_string,$_min_num) {
    global $errData;
    //判断密码
    if (strlen($_string) < $_min_num) {
        $errData .= '密码不得小于'.$_min_num.'位！'."<br>";
    }

    //将密码返回
    return sha1($_string);
}


/**
 * _check_code
 * @param string $_first_code
 * @param string $_end_code
 * @return void 验证码比对
 */

function _check_code($_first_code,$_end_code) {
    global $errData;
    if ($_first_code != $_end_code) {
        $errData .= '验证码不正确!'."<br>";
    }
}


function _check_repassword($pwd,$repwd){
    global $errData;
    if($pwd!=$repwd){
        $errData .= '前后输入的两次密码不一致'."<br>";
    }
}

function _check_uniqid($_first_uniqid,$_end_uniqid) {
    global $errData;
    if ((strlen($_first_uniqid) != 40) || ($_first_uniqid != $_end_uniqid)) {
        $errData .= "你不是从本页面提交的表单<br>";
        echo "<script>history.back()</script>";
    }

    return _mysql_string($_first_uniqid);
}