<?php
    session_start();
    define("IN_TG",true);
    require $_SERVER["DOCUMENT_ROOT"]."/functions/captchaFun.php";
    _code();