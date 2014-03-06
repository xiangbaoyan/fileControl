<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copToMulDirFile.php';
//目录
$proDir2 = @$_POST['proDir2'];
//页面
$page = @$_POST['page'];

if (!file_exists($page)) {
    popWin("请输入一个文件名，而不是目录名");
}

//分析页面
$pageData = file_get_contents($page);

/*
 * 移动所有的css文件
 *
 */
preg_match_all("/(?<=href\=\")[^\"]+\.css/U", $pageData, $matches);

foreach ($matches[0] as $cssFile) {

    $cssOldFile = dirname($page) . "/" . $cssFile;

    $newFile = $proDir2 . "/" . $cssFile;

    if (file_exists($cssOldFile)) {

        copToMulDirFile($cssOldFile, $newFile);

        //css的背景图片;

        $cssOldData = file_get_contents($cssOldFile);
        preg_match_all("/(?<=url\(\").+\.(png|jpg|gif)/", $cssOldData, $cssImgs);
        foreach ($cssImgs[0] as $cssImg) {

            $cssImg = dirname($page) . "/images/" . basename($cssImg);
            if (file_exists($cssImg)) {
                $newImg = $proDir2 . "/images/" . basename($cssImg);
                copToMulDirFile($cssImg, $newImg);
            }
        }
    }
}

/*
 * 移动所有的js文件
 */

preg_match_all("/(?<=src\=\")[^\"]+\.js/U", $pageData, $jsFiles);

foreach ($jsFiles[0] as $jsFile) {
    $jsOldFile = dirname($page) . "/" . $jsFile;

    $newFile = $proDir2 . "/" . $jsFile;

    if (file_exists($jsOldFile)) {

        copToMulDirFile($jsOldFile, $newFile);
    }
}


/*
 * 移动所有图片
 */

preg_match_all("/[^\'\"]*(\.gif|\.jpg|\.png)/", $pageData, $imgFiles);

foreach ($imgFiles[0] as $imgFile) {
    $imgOldFile = dirname($page) . "/" . $imgFile;

    $newFile = $proDir2 . "/" . $imgFile;

    if (file_exists($imgOldFile)) {

        copToMulDirFile($imgOldFile, $newFile);
    }
}



/*
 * 移动这个文件
 */

copToMulDirFile($page,$proDir2."/".basename($page));

popWin("成功转移文件");