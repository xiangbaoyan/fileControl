<div class="panel-group" id="accordion7">
    <div class="panel">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion7"
           href="#collapse7"
           style="color: white;text-align: center;text-decoration: none">
            <div class="panel-heading" style="background-color: green">
                <h4 class="panel-title">
                    jquery函数的添加
                </h4>
            </div>
        </a>
        <div id="collapse7" class="panel-collapse collapse">
            <div class="panel-body">
<!--                这是jquery ajax验证函数-->
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel-body">
                            <div class="panel panel-danger" id="user">
                                <div class="panel-heading">jquery ajax验证函数</div>
                               <pre>
                                       $(function(){
                                           var error=new Array();
                                           $('input[name="username"]').blur(function(){
                                               var username=$(this).val();
                                               $.get('__URL__/checkName',{'username':username},function(data){
                                                   if(data=='不允许'){
                                                       error['username']=1;
                                                       $('input[name="username"]').after('<p id="umessage"
                                                                                             style="color:red">
                                       该用户名已经注册</p>');
                                                   }else{
                                                       error['username']=0;
                                                       $('#umessage').remove();
                                                   }
                                               });
                                           });

                                           //提交表单
                                           $('img.register').click(function(){
                                               if(error['username']==1){
                                                   return false;
                                               }else{
                                                   $('form[name="myForm"]').submit();
                                               }
                                           });
                                       });
                               </pre>
                            </div>
                        </div>
                    </div>
                </div>
<!--                这是另外的函数-->
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel-body">
                            <div class="panel panel-danger" id="user">
                                <div class="panel-heading">jquery 表单验证函数</div>
                               <pre>
                                     script
                                         formCheckAndSub('form', 'nameNull');
                                         //必须规范form表单名称为email，password,repassword,username,
                                         function formCheckAndSub(formId, errId) {

                                             $("#" + formId).submit(function () {
                                                 var flag = true;
                                                 $("#" + errId).html("");
                                                 $("#" + formId + " input").each(function () {
                                                     if ($(this).attr("name") == "email") {
                                                         if (!checkEmail($(this).val())) {
                                                             alert("woyun");
                                                             $("#" + errId).html("邮件填写错误").css("display", "block");
                                                             flag = false;
                                                         }
                                                     } else if ($(this).attr("name") == "password") {
                                                         if (!checkPassword($(this).val())) {
                                                             $("#" + errId).html($("#" + errId).html() + "<br>密码填写错误,有效长度为6到12位").css("display", "block");
                                                             flag = false;
                                                         }
                                                     } else if ($(this).attr("name") == "username") {
                                                         if (!checkUsername($(this).val())) {
                                                             $("#" + errId).html($("#" + errId).html() + "<br>用户名填写错误,有效长度为6到20位").css("display", "block");
                                                             flag = false;
                                                         }
                                                     } else if ($(this).attr("name") == "repassword") {
                                                         if ($(this).val() != $("#" + formId + " input[name=" + "'password']").val()) {
                                                             $("#" + errId).html($("#" + errId).html() + "<br>两次输入的密码不一致").css("display", "block");
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
                                         function checkEmail(str) {

                                             var myReg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
                                             if (myReg.test(str)) {
                                                 return true;
                                             }
                                             return false;
                                         }
                                         function checkPassword(str) {
                                             var myReg = /\w{6,40}/;
                                             if (myReg.test(str)) {
                                                 return true;
                                             }
                                             return false;
                                         }

                                         function checkUsername(str) {
                                             var myReg = /\w{6,20}/;
                                             if (myReg.test(str)) {
                                                 return true;
                                             }
                                             return false;
                                         }
                                         function backHis() {
                                             location.href = "/activePage/m.php";
                                         }
                                         function showOrHide(id) {
                                             var tardiv = $("#" + id);
                                             if (tardiv.css("display") == "none") {
                                                 tardiv.css("display", "block");
                                             } else {
                                                 tardiv.css("display", "none");
                                             }
                                         }
                                     /script
                               </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>