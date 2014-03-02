<?php

/**
 * 改写ini文件的变量配置
 */
function dealIniPara($para, $value,$cate="",$conDir="config.ini")
{
    $conDir = BASE_DIR . "\\{$conDir}";
    $con = parse_ini_file($conDir);
    if (empty($con[$para])) {
         /*
          * 这是添加参数
          */

        //如果有类别的存在
        if($cate!=""){
            $data = file_get_contents($conDir);
            $data = preg_replace("/\[{$cate}\]/","\${0}\r{$para}=\"{$value}\"\r",$data);
            file_put_contents($conDir,$data);
        }else{
            file_put_contents($conDir,"\r{$para}=\"{$value}\"",FILE_APPEND);
        }
    } else {
        /*
         * 这是修改参数
        * 如果
        * -要设置的值:$value
        * 跟
        * -参数的$para的值:$con[$para]
        * 不同
        */
        if ($value != $con[$para]) {

            //使用的是正则的方法

            $data = file_get_contents($conDir);
            $pattern = "/(?<=".$para."\=\").*(?=\")/U";

            $data = preg_replace($pattern,$value,$data);
            file_put_contents($conDir,$data);

        } else {
            popWin("参数值未作修改");
        }
    }
}