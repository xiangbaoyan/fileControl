<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/lib/simplehtmldom_1_5/simple_html_dom.php';
require BASE_DIR . '/functions/creMulDir.php';
require BASE_DIR . '/functions/dealIniPara.php';
require BASE_DIR . '/functions/creModCssData.php';
require BASE_DIR . '/functions/movModImg.php';
/*
 * 读取model.ini 文件
 */
//$con = parse_ini_file(BASE_DIR . "/js.ini");
//$conCount = sizeof($con);


/*
 * 读取config.ini 文件
 * 读取目标文件的目录；
 */
$config = parse_ini_file(BASE_DIR . "/config.ini");

$proDir = $config['proDir'];
/*
 * 接受POST变量
 */
$file = mysql_real_escape_string(@$_POST['file']);

session_start();
$_SESSION['file'] = $file;


$id = @$_POST['id'];
$class = @$_POST['class'];
//$sourPage = @$_POST['sourPage'];
//$cate = @$_POST['cate'];
//$sonCate = @$_POST['sonCate'];

$desFile = BASE_DIR . "/modules/";

//取得文件数，来命名

$dirArr = scandir(BASE_DIR."/modules");
$conCount = count($dirArr)-2;



if (empty($file)) {

    popWin("没有提交要截取的网页路径");
}
unset($html);
$html = file_get_html($file);
//从这找到所有css文件
$abName = [];
foreach ($html->find('link') as $link) {
    $abName[] = $proDir . $link->href;
}

if (empty($html)) {
    popWin("该网页没有数据");
}
//存放的新的文件名
//模块的目录
$modDir = $desFile . "div" . ($conCount + 1);
$newFile = $modDir . "/index.php";
creMulDir(dirname($newFile));
//进行对div 的操作
if (!empty($id)) {

    $data = $html->find("#" . $id,0);
    if ($data) {
        $arr = array_unique(getIdClass($data));
        //存入该模块的index.php
        //为data增加css link，
        //放在data数据的开头
        $str = "<link rel=\"stylesheet\" type=\"text/css\" href=\"index.css\"  />\r";
        file_put_contents($newFile, $str . $data);
        //取得要生成的css;
        $desCssData = creModCssData($data, $abName);
        $desCssFile = $modDir . "/index.css";
        //移动相应的图片
        movModImg($desCssData);
        file_put_contents($desCssFile, $desCssData);
        popWin("拆解成功" . "{$desCssFile}");
    } else {
        popWin("截取的元素内容不存在");
    }
} elseif (!empty($class)) {
    $data = $html->find("." . $class, 0);
    if ($data) {
        $arr = array_unique(getIdClass($data));
        //存入该模块的index.php
        //为data增加css link，
        //放在data数据的开头
        $str = "<link rel=\"stylesheet\" type=\"text/css\" href=\"index.css\"  />\r";
        file_put_contents($newFile, $str . $data);
        //取得要生成的css;
        $desCssData = creModCssData($data, $abName);
        $desCssFile = $modDir . "/index.css";
        //移动相应的图片
        movModImg($desCssData);
        file_put_contents($desCssFile, $desCssData);

        popWin("拆解成功" . "{$desCssFile}");
    } else {
        popWin("截取的元素内容不存在");
    }


}


//新的参数名:
//$para = "div" . ($conCount + 1);
//dealIniPara($para, $sourPage, "", "js.ini");
//结束操作
$html->clear();
unset($html);




