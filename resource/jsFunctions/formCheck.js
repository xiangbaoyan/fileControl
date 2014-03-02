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
                    flag= false;
                }
            } else if ($(this).attr("name") == "password") {
                if (!checkPassword($(this).val())) {
                    $("#" + errId).html($("#" + errId).html() + "<br>密码填写错误,有效长度为6到40位").css("display", "block");
                    flag= false;
                }
            } else if ($(this).attr("name") == "username") {
                if (!checkUsername($(this).val())) {
                    $("#" + errId).html($("#" + errId).html() + "<br>用户名填写错误,有效长度为6到20位").css("display", "block");
                    flag= false;
                }
            } else if ($(this).attr("name") == "repassword") {
                if ($(this).val() != $("#" + formId + " input[name=" + "'password']").val()) {
                    $("#" + errId).html($("#" + errId).html() + "<br>两次输入的密码不一致").css("display", "block");
                    flag= false;
                }
            }
        });
        if(flag == true){return true}
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