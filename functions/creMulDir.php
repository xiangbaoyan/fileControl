<?php
/**
 * 创建多级目录
 *
 * @return string   返回创建好的目录
 */
function creMulDir($dir) {

        if (!is_dir($dir)) {

            creMulDir(dirname($dir));
            mkdir($dir);
        }
    }