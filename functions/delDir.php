<?php

    function delDir($dir){
         $it = new DirectoryIterator($dir);
        foreach($it as $value){
            if(!$it->isDot()){
                if(is_dir($dir."/".$value)){
                    delDir($dir."/".$value);

                }else{
                    unlink($dir."/".$value);
                }
            }
        }
        rmdir($dir);
    }