<?php
/**
 * 修改页面的html链接成为.php链接
 *
 * @param $data
 *
 * @return void
 */

function modHtmToPhp(&$data) {

        $data = str_replace(".html",".php",$data);
    }