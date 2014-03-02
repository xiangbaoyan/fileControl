<html>
<head>
    <title>主页</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/index.css"/>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>

    <button type="button" id="btn1" class="btn btn-primary btn-lg ">
               <i class="glyphicon glyphicon-plus"></i>
               <span>添加按钮</span>
    </button>

    <div id="php"></div>
</body>
<script>
        $("#btn1").click(function(){
            $.post("test.php");
        })
</script>
</html>