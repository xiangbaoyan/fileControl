<?php
require $_SERVER['DOCUMENT_ROOT']."/functions/modUrlPath.php";
require $_SERVER['DOCUMENT_ROOT']."/functions/delNotes.php";
require $_SERVER['DOCUMENT_ROOT']."/functions/popWin.php";
$cssFile = @$_POST['cssFile'];
$subCon = @$_POST['subCon'];

if($cssFile && $subCon){
    $cssData = file_get_contents($cssFile);

//    modUrlPath($cssData);
    delNotes($cssData);
    file_put_contents(dirname($cssFile)."/newCss.css",$cssData);
    popWin("修改生成css文件成功");
}
?>
<form role="form" method="post" action="dealSinglePage.php" class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-md-3">输入要处理的css文件全路径名:</label>
     <div class="col-md-4">
         <input type="text" class="form-control" name="cssFile" placeholder="输入css的地址">
     </div>
      <div class="col-md-2">
          <input type="text" class="form-control" name="subCon" value="../../Images/">
      </div>
      <button type="submit" class="btn btn-success">生成css文件</button>
  </div>
</form>