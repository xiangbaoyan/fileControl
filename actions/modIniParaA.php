<?php
require $_SERVER['DOCUMENT_ROOT'] . "/functions/common.php";
require BASE_DIR . "/functions/dealIniPara.php";

//假设这提交的是配置文件的参数名
$paraValue = $_POST['paraValue'];
$paraName = @$_POST['paraName'];

/*
 * 如果提交的参数值非空
 */
if ($paraValue) {
    /*
     *如果提交过来的参数值是存在的目录名
     */
    if (is_dir($paraValue)) {

        //设置目录的配置文件
        dealIniPara("proName", $paraValue);
        //设置生成的产品目录的配置文件
        dealIniPara("proDir", $paraValue . "-final");
        popWin("修改目录成功");
    }

    /*
     * 如果提交过来的是api，用.php 标记
     */
    if (strpos($paraName, '.php') > -1) {

        //设置api的配置文件
        dealIniPara($paraName, $paraValue);
        popWin("修改config.ini参数说明成功");
    }
    if (strpos($paraName, '.js') > -1) {

        //设置api的配置文件
        dealIniPara($paraName, $paraValue,"","js.ini");
        popWin("修改参数说明成功");
    }

    if (strpos($paraName, 'Fun') > -1) {

        //设置api的配置文件
        dealIniPara($paraName, $paraValue,"","php.ini");
        popWin("修改php.ini参数说明成功");
    }

} else {
    popWin("请认真填写配置文件的参数值");
}






