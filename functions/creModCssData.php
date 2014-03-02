<?php
if (!function_exists('getIdClass')) {
    require "getIdClass.php";
}


/**
 * 生成模块页面里的css 数据
 *
 * @param string $data 模块页面的数据
 *
 * @param array $abName 所有原始的css文件
 *
 * @return string  返回一个联合的css数据
 */
function creModCssData(&$data, $abName)
{
    //定义最后取出所有css元素的数组
    $elems = [];
    //找到页面所有的id 和class
    $arr = array_unique(getIdClass($data));
    //还要找到存放这些id和cl ass的css页面,并取出数据放在一个数组

    //取出每个css文件进行匹配
    foreach ($abName as $file) {
        $cssData = file_get_contents($file);

        //$tarCssElem 表示每个id和class
        foreach ($arr as $tarCssElemR) {

            $tarCssElem = preg_quote($tarCssElemR);
            //取出css段的正则[^\}]*   .new-icon4 span     [^\}]*}
            //[\s\{]
            $pattern = "/[^\}]*" . $tarCssElem . "[^-_\d][^\}]*\}/";
            $pattern2 = "/[^\}]*(?=" . $tarCssElem . "[^-_\d])/";

            preg_match_all($pattern, $cssData, $matches);
            $matches[1] = [];
            for ($i = 0; $i < sizeof($matches[0]); $i++) {
                preg_match($pattern2, $matches[0][$i], $mat);
                $matches[1][$i] = $mat[0];
            }
            /*
             * 下面比过滤 ，一个元素前面是已有元素
             */
            //这个tarCssElem就是要找的这个元素
//判断一个elem 里面 如果包含arr中的一个元素，那么这个元素前面 的元素必须也在arr中
            //这样就必须对$matches[0]进行过滤，
            //举例：如果$matches[1][1]中不包含arr中的元素，就删掉$matches[0][1]
            foreach ($matches[1] as $key => $value) {
                $flag = false;
                //还得包含为空的情况

                if (trim($value) == "") {
                    $flag = true;
                }
                //这个arrVal 还不能是自己
                foreach ($arr as $arrVal) {
                        if($arrVal!=$tarCssElemR)
                        {
                            //找到了存在的CSSID，但可以是自己
                            if (strpos($matches[1][$key], $arrVal) > -1) {
                                $flag = true;
                            }
                        }
                };
                    //找到判断arr里的元素在css文件里的地方
                //false 代表删除这个css块
                if ($flag == false) {
                    unset($matches[0][$key]);
                }
            }
            //从css页面数据中找到匹配这个的css


            $elems = array_merge($elems, $matches[0]);
            $elems = array_unique($elems);
        }

    }

    $desCssData = implode("\r", $elems);


    return $desCssData;
}