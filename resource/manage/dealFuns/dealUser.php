<?php
define("IN_TG", true);
require $_SERVER['DOCUMENT_ROOT'] . '/functions/mysqlFun.php';
require $_SERVER['DOCUMENT_ROOT'] . '/functions/delDirFun.php';


_connect();
_select_db();
_set_names();

$username = @$_POST['username'];
$method = @$_POST['method'];
if ($method == "delUser") {
    /*
     * 取出用户的文件夹
     */
    $sql = "select tg_userDir from tg_user where tg_username ='{$username}'";
    $row = _fetch_array($sql);
    $userDir = $row['tg_userDir'];

    /*
     * 从数据库删除这个用户
     */
    $sql = "delete from tg_user where tg_username = '{$username}'";
    _query($sql);

    if (_affected_rows() == 1) {
        $desDir = $_SERVER['DOCUMENT_ROOT'] . $userDir;

        $pattern = "|{$_SERVER['DOCUMENT_ROOT']}/users/\w{10}|";
        if (preg_match($pattern, $desDir)) {
            delDir($desDir);
        }
        echo "删除成功";
    }
}
if ($method == "promUser") {
    $sql = "update tg_user set tg_level = tg_level + 1 where tg_username='{$username}'";
    _query($sql);
    if (_affected_rows() == 1) {
        $sql = "select tg_level from tg_user where tg_username='{$username}'";
        $row = _fetch_array($sql);
        echo levelToName($row['tg_level']);
    }
}


if ($method == "deProUser") {
    $sql = "update tg_user set tg_level = tg_level - 1 where tg_username='{$username}'";
    _query($sql);
    if (_affected_rows() == 1) {
        $sql = "select tg_level from tg_user where tg_username='{$username}'";
        $row = _fetch_array($sql);
        echo levelToName($row['tg_level']);
    }
}
?>