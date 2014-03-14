<?php
define("IN_TG",true);
require $_SERVER['DOCUMENT_ROOT']."/functions/commonFun.php";

//接受与判断
$prodName = @$_POST['prodName'];

$prodIns = @$_POST['prodIns'];

$prodOldPri = @$_POST['prodOldPri'];

$prodNewPri = @$_POST['prodNewPri'];

$prodImg = @$_FILES['prodImg']['tmp_name'];

if ($_FILES["prodImg"]["error"] > 0)
{
    echo "error: " . $_FILES["prodImg"]["error"] . "<br />";
    exit;
}

if ($_FILES['prodImg']['size'] > 1024*1024){
    echo "<script>alert('图片文件超过1M')</script>";
    exit;
}

//生成图片新的文件名
$meg = md5(uniqid(mt_rand(),true));
$oldFile = $_FILES['prodImg']['name'];

$newImgName = preg_replace("/[^\.]+(?=\.)/",$_SERVER['DOCUMENT_ROOT']."/goodImgs/{$meg}",$oldFile);
$prodImgDB = preg_replace("/[^\.]+(?=\.)/","/goodImgs/{$meg}",$oldFile);


//操作数据库
require $_SERVER['DOCUMENT_ROOT']."/functions/mysqlFun.php";
_connect();
_select_db();
_set_names();


$sql = "insert into tg_good
                    (
                    tg_pName,
                    tg_pIns,
                    tg_pOlodPrice,
                    tg_pNewPrice,
                    tg_pMainImg
                     )
             values (
                    '{$prodName}',
                    '{$prodIns}',
                    '{$prodOldPri}',
                    '{$prodNewPri}',
                    '{$prodImgDB}'
             )
                          ";

_query($sql);
if(_affected_rows()==1){
    move_uploaded_file($prodImg,$newImgName);
    echo "<script>alert('成功发布');history.back();</script>";
}

