<?php
require $_SERVER['DOCUMENT_ROOT'] . '/functions/common.php';

//动态生成所有文件的列表
$con = parse_ini_file(BASE_DIR . "/config.ini");
$it = new RecursiveDirectoryIterator($con['proName']);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<ul class="list-group">
    <?php foreach (new RecursiveIteratorIterator($it) as $file) {

        if (!preg_match("/\.$/", $file)) {
            ?>
            <li class="list-group-item"><?php echo $file ?></li>

        <?php
        }
    } ?>
</ul>
</body>
</html>
    