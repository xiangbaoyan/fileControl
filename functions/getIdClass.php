<?php

function addDot($val) {
    return  ".{$val}";
}


/**
 * @param $data
 *
 * @return array
 */

function getIdClass($data) {

        $arr = [];

        preg_match_all("/(?<=class=\")(.*)\"/U",$data,$matches);

        //var_dump($matches[1]);

    foreach($matches[1] as $value)
    {
        //这个需要分解string 'box lt-li' (length=9)
        if(preg_match("/[\S]+\s[\S]+/",$value)){

            $arr2 = explode(" ",$value);

            $arr2 = array_map("addDot",$arr2);
            array_merge($arr2,$arr);
        }else{
            $arr[] = ".{$value}";
        }
    };


    preg_match_all("/(?<=id=\")(.*)\"/U",$data,$matches);

    foreach($matches[1] as $value){

        $arr[]= "#{$value}";
    }
    return $arr;

}


