<?php
/**
 * 根据指定内容弹窗
 */
function popWin($str) {

        echo "<script>alert(\"{$str}\");history.back();</script>";
    }