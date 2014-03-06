<?php
    define("IN_TG",true);
    require $_SERVER['DOCUMENT_ROOT']."/functions/mysqlFun.php";
    _connect();
    _select_db();
    _set_names();
    $sql = "select tg_title,tg_slogan from tg_html where tg_id = 1";
    $row = _fetch_array($sql);
    _close();
?>

<!-- BEGIN PAGE HEADER-->

<div class="row-fluid">

    <div class="span12">

        <!-- BEGIN PAGE TITLE & BREADCRUMB-->

        <h3 class="page-title">

            <strong>主页标题</strong>&nbsp;
            <small>定制内容</small>

        </h3>

        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="index.php">主页</a>

                <i class="icon-angle-right"></i>

            </li>

            <li><a href="#">
            </a></li>

        </ul>

        <!-- END PAGE TITLE & BREADCRUMB-->

    </div>

</div>

<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->

<div class="row-fluid">

    <div class="span12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->

        <div class="portlet box green">

            <div class="portlet-title">

                <div class="caption"><i class="icon-cogs"></i>详细内容</div>

                <div class="tools">

                    <a href="javascript:;" class="collapse"></a>

                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                    <a href="javascript:;" class="reload"></a>

                    <a href="javascript:;" class="remove"></a>

                </div>

            </div>

            <div class="portlet-body form">

                <!-- BEGIN FORM-->

                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">网站标题:</label>

                        <div class="controls">
                            <div class="form">
                                <input type="text" name="title" value="<?php echo $row['tg_title']?>" class="m-wrap small"/>
                                <span class="help-inline">三个字效果最佳</span>
                                <!--这个按钮被点击 则input:title 的内容将被ajax提交-->
                                <button style="margin-left: 30px" class="btn blue">提交</button>
                            </div>
                        </div>

                    </div>

                    <div class="control-group">
                        <label class="control-label">标语:</label>
                        <div class="controls">
                            <div class="form">
                                <input type="text" name="slogan"  value="<?php echo $row['tg_slogan']?>" class="m-wrap small"/>
                                <span class="help-inline">六个字最佳</span>
                                <button style="margin-left: 30px" class="btn blue">提交</button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- END FORM-->

            </div>

        </div>

        <!-- END SAMPLE TABLE PORTLET-->

    </div>

</div>

<!-- END PAGE CONTENT-->

<script>

    $('.select2').select2({

        placeholder: "Select an option",

        allowClear: true

    });

    $('div .form button').click(function(){
        var name = $(this).siblings("input").attr("name");
        var con = $(this).siblings("input").val();
        $.post("/activePage/m.php",{name:name,con:con},function(){
            alert("保存成功");
        })

    });

</script>