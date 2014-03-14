<?php
define("IN_TG", true);
require $_SERVER['DOCUMENT_ROOT'] . "/functions/commonFun.php";
require $_SERVER['DOCUMENT_ROOT'] . "/functions/mysqlFun.php";

function insertUsers()
{

    $arr['userDir'] = "/users/" . substr(_sha1_uniqid(), 0, 10);
    mkdir($_SERVER['DOCUMENT_ROOT'] . $arr['userDir']);
    $arr['userName'] = "test" . substr(_sha1_uniqid(), 0, 4);

    $arr['password'] = substr(_sha1_uniqid(), 0, 9);
    $arr['uniqid'] = _sha1_uniqid();
    $sexArr = ["m", "w"];
    $arr['sex'] = $sexArr[array_rand($sexArr)];
    $sql = "insert into tg_user ( tg_userDir,
                                      tg_username,
                                      tg_password,
                                      tg_uniqid,
                                      tg_sex
                                      )
                              values (
                                      '{$arr['userDir']}',
                                      '{$arr['userName']}',
                                      '{$arr['password']}',
                                      '{$arr['uniqid']}',
                                      '{$arr['sex']}'
                              )";

    _query($sql);
}


_connect();
_select_db();
_set_names();

for ($i = 0; $i < 150; $i++) {
    insertUsers();
}

_close();
?>