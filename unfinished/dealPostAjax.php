<?php
//
//采用的是粘贴事件
//现在问题是 必须得到原始数据，
$text = @$_POST['text'];

//取得正则表达式的内容;
$rex = @$_POST['rex'];


//定义发送回的数组$arr,里面都是匹配到的;
$matches = [];

preg_match_all("{$rex}",$text,$matches);

$matches = array_unique($matches);

echo json_encode($matches);




