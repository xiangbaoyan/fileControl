<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';
require BASE_DIR . '/functions/copToMulDirFile.php';

$phpes = @$_POST['phpes'];
$proPage = @$_POST['proPage'];
$codeSegs = @$_POST['codeSegs'];

if(count($phpes)>0){
    $phpDir = BASE_DIR . "/resource/phpFunctions";

    $newDir = $projectDir ."/functions";
    foreach ($phpes as $phpFile) {
        $oldFile = $phpDir . "/" . $phpFile;
        $newFile = $newDir."/{$phpFile}";
        copToMulDirFile($oldFile,$newFile);
        if($phpFile == "captchaFun.php"){
            copToMulDirFile(BASE_DIR . "/resource/code.php",$projectDir."/code.php");
        }
//        if($phpFile == "serverCheckFun.php"){
//            $patchContent = file_get_contents(BASE_DIR . "/resource/codeSeg/serverCheckInRegFun.txt");
//            $desFileData = file_get_contents($proPage);
//            $desFileData = $patchContent."\r".$desFileData;
//            file_put_contents($proPage,$desFileData);
//        }
    }
}


if(count($codeSegs)>0){
    foreach($codeSegs as $codeSeg){
        $oldFile = BASE_DIR."/resource/codeSeg/".$codeSeg;
        $oldData = file_get_contents($oldFile);
        $data = file_get_contents($proPage);
        $data = str_replace("<!DOC",$oldData."\r"."<!DOC",$data);
        file_put_contents($proPage,$data);
    }
}
