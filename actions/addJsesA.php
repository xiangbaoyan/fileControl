<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copMulFileToOneFile.php';

$jses = @$_POST['jses'];
$pageName = @$_POST['pageName'];

//if (count($jses) > 0 && $pageName) {
//    $jsDir = BASE_DIR . "/resource/jsFunctions";
//    $data = "";
//    /*
//     * 取出所有js 内容拼凑在一起成$data ,
//     * 放在$page 的</body>后面
//     */
//    foreach ($jses as $jsFile) {
//
//        $data .= "\r" . file_get_contents($jsDir . "/" . $jsFile);
//    }
//    $pageData = file_get_contents($pageName);
//    $pageData = str_replace("</body>", "</body>\r<script>" . $data."\r</script>", $pageData);
//    file_put_contents($pageName, $pageData);
//    echo "成功输入";
//
//} else {
//    echo "没有js或者没有提交页面名称";
//}


$jsDir = BASE_DIR . "/resource/jsFunctions";
$filePathArray = [];
foreach ($jses as $jsFile) {
    $filePathArray[] = $jsDir . "/" . $jsFile;
}
copMulFileToOneFile($filePathArray,$pageName,"</body>","<script>");

