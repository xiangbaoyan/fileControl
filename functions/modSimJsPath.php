<?php

function callProJs2($matches) {

    return "js/".basename($matches[0]);
}


function modSimJsPath(&$data) {
    $data = preg_replace_callback("/(?<=src\=\")[^\"]+\.js/U","callProJs2",$data);
}