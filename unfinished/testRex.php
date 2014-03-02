<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>
<body style="margin-top: 50px;">


<div class="row">
    <div  class="form-horizontal col-sm-8 col-sm-offset-1">
        <input id="hide" type="hidden"/>
        <div class="form-group">
            <label for="rex" class="col-sm-2 control-label">书写正则:</label>

            <div class="col-sm-5">
                <input class="form-control" style="font-size: 20px" type="text" id="rex" name="rex"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="area">粘贴内容:</label>
            <textarea style="" id="area" cols="120" rows="100">
            </textarea>

            <div class="col-sm-10">
                <div class="form-control" contenteditable="true" id="text"
                     style="display:none;font-size:18px;background-color: lightgray;height: auto;overflow: auto">
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-1" style="background-color: green;height: 100px">

    </div>
</div>

<script type="text/javascript">
    //必须有个初始的事件让php 获得 初始值
    //var time1 = new Data();
    //只要这次事件执行后100毫秒没有下一次事件，就执行函数
    //关键是判断这100毫秒内是否有第二次事件

    //设置flag,如果设置false ，判断100毫秒内变成true了，就不执行，反证：如果执行了2次，就又成true了
    //设置flag到500毫秒就把他置为true 可行；
    var data= "";
    var i=0;
    //问题是保留不住回车换行。


    //主要问题是把div 里的标签任意字符也替换了，所以不真实了
    $("#area").blur(function(){
        $("#area").css("display","none");
        $("#text").html($("#area").val());
        $("#text").css("display","block");
    });


    $("#rex").bind('keyup', function () {
        //必须让doPost 延时执行，并且是执行最后一次命令
            doChan();
    });

    function doChan() {
        if(i==0){
            data = $("#text").html();
        }
        var rex = $("#rex").val();
        if (/\/[\S]+\//.test(rex)) {
            i++;
            rex = eval(rex+"g");
            var content = data.replace(rex, "<span style=\"color:red\">$&</span>");

            $("#text").html(content);
        }
    }

</script>

</body>
</html>

