<div style="margin-top: 50px">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="merchantGuy.php">
                后台主页
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="fa fa-legal"></i>
            <a href="#">
                发布商品:
            </a>
        </li>
    </ul>

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>商品详细信息
            </div>
        </div>
        <div class="portlet-body">
            <div id="err" style="color:red;margin-left: 20px;font-size: 18px"></div>
            <form action="dealFuns/dealProd.php" class="form form-horizontal" id="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-2">商品名称:<span class="aster">*</span></label>

                    <div class="col-sm-7">
                        <input type="text" name="prodName" class="form-control"/>
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <span style="display: inline-block">建议10个字以内</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">商品描述:<span class="aster">*</span></label>

                    <div class="col-sm-7">
                        <input type="text" name="prodIns" class="form-control"/>
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <span style="display: inline-block">建议10个字以内</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">商品原价(只写数字):<span class="aster">*</span></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <button class="btn green cutPrice" type="button">-</button>
                            </span>
                            <span class="input-group-addon">￥</span>
                            <input name="prodOldPri" type="text" value="2" class="form-control">
                            <span class="input-group-addon"></span>
                            <span class="input-group-btn">
                            <button class="btn green addPrice" type="button">+</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <span style="display: inline-block">建议10个字以内</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">商品现价(只写数字):<span class="aster">*</span></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <button class="btn green cutPrice" type="button">-</button>
                            </span>
                            <span class="input-group-addon">￥</span>
                            <input name="prodNewPri" type="text" value="1" class="form-control">
                            <span class="input-group-addon"></span>
                            <span class="input-group-btn">
                            <button class="btn green addPrice" type="button">+</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <span style="display: inline-block">建议10个字以内</span>
                    </div>
                </div>


                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                    <!--start选择图片-->
                        <label class="control-label col-sm-2">选择一张商品图片:
                            <span class="aster">*</span>
                        </label>
                        <div class="col-sm-7">
                            <div class="thumbnail" style="width: 200px; height: 150px;">
                                <img src="" id="preImg"/>
                            </div>
                            <div>
                             <span class="btn green btn-file">
                             选择图片
                            <input type="file" id="preInput" name="prodImg">
                            </span>
                            </div>
                        </div>
                    <!--end选择图片-->
                </div>
                <div class="form-group">
                    <input type="submit" value="发布" class="btn green form-control"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!--js-->

<!--预览图片-->
<script>
    (function () {
        var viewFiles = document.getElementById("preInput");
        var viewImg = document.getElementById("preImg");

        function viewFile(file) {
            //通过file.size可以取得图片大小
            var reader = new FileReader();
            reader.onload = function (evt) {
                if(file.size>1024*1024){
                    alert("文件大小超过了1M");
                    viewFiles.value = "";
                }else{
                    viewImg.src = evt.target.result;
                }
            };
            reader.readAsDataURL(file);
        }

        viewFiles.addEventListener("change", function () {
            //通过 this.files 取到 FileList ，这里只有一个
            viewFile(this.files[0]);
        }, false);
    })();


</script>
<!--验证js-->
<script>
    formCheckAndSub('form', 'err');
    //必须规范form表单名称为email，password,repassword,username,
    function formCheckAndSub(formId, errId) {
        $("#" + formId).submit(function () {
            var flag = true;
            $("#" + errId).html("");
            $("#" + formId + " input").each(function () {
                if ($(this).attr("name") == "prodName") {
                    if ($(this).val().length>20 || $(this).val().length<3) {
                        $("#" + errId).html("错误:商品名称长度不合要求，需要在3到20个字符");
                        flag = false;
                    }
                } else if ($(this).attr("name") == "prodIns") {
                    if ($(this).val().length>20 || $(this).val().length<3) {
                        $("#" + errId).html("错误:商品描述长度不合要求，需要在3到20个字符");
                        flag = false;
                    }
                } else if ($(this).attr("name") == "prodOldPri") {
                    if ($(this).val().length>20 || $(this).val().length<3) {
                        $("#" + errId).html("错误:商品原价格长度不合要求，需要在3到20个字符");
                        flag = false;
                    }
                } else if ($(this).attr("name") == "prodNewPri") {
                    if ($(this).val().length>20 || $(this).val().length<3) {

                        $("#" + errId).html("错误:商品新价格长度不合要求，需要在3到20个字符");
                        flag = false;
                    }
                }
            });
            if (flag == true) {
                return true
            }
            //如果上面没有错就显示，但是无论如何都要执行到下面
            return false;
        });
    }

</script>
<!--价格调节按钮-->
<script>
    $(".addPrice").click(function () {

        var nowP = parseInt($(this).parent().siblings("input").val());
        $(this).parent().siblings("input").val(nowP + 1);

    });

    $(".cutPrice").click(function () {

        var nowP = parseInt($(this).parent().siblings("input").val());
        if (nowP > 0) {
            $(this).parent().siblings("input").val(nowP - 1);
        }

    });

</script>

