//初始状态curPage 为 1;
$.cookie("curPage",1,{expires: 1});

//取得当前页的所在页码范围;
//如果6 就是 1，10
// var minNum = parseInt（）
// 也就是 min: curPage/10 * 10  max:(curPage/10+1)*10
showLis();
function showLis(){
    var minPage = parseInt($.cookie("curPage")/10)*10;
    var maxPage = minPage+10;
    $("ul.pagination li.liNum").each(function(i){
        var that = $(this);
        $(this).click(function(){
            var num = $.cookie("curPage");
            $("li[mytag = '"+num+"']").removeClass("active");
            $.cookie("curPage",that.attr("mytag"));
            that.addClass("active");
            ajPost();
        });

        if(i== ($.cookie("curPage")-1)){
            $(this).addClass("active");
        }else{
            $(this).removeClass("active")
        }

        if($(this).attr("mytag")>=minPage && $(this).attr("mytag")<=maxPage){
            $(this).css("display","inline-block");
        }else{
            $(this).css("display","none");
        }
    });

}


$("#nextTen").click(function(){
    var maxPageNexMin = parseInt($.cookie("curPage")/10)*10+10;
    if(maxPageNexMin<= $.cookie("pageSum")){
        $.cookie("curPage",maxPageNexMin);
        showLis();
        ajPost();
    }

});

$("#lastTen").click(function(){
    var minPageNexMax = parseInt($.cookie("curPage")/10)*10-10;
    if(minPageNexMax>=1){
        $.cookie("curPage",minPageNexMax);
        ajPost();
        showLis();
    }

});

var pageSum = parseInt($.cookie("pageSum"));
$("#nextOne").click(function(){
    if($.cookie("curPage") <= pageSum){
        $.cookie("curPage", parseInt($.cookie("curPage"))+1);
        ajPost();
        showLis();
    }
});

$("#lastOne").click(function(){
    if($.cookie("curPage")>0){
        $.cookie("curPage", $.cookie("curPage")-1);
        ajPost();
        showLis();
    }
});

ajPost();
function ajPost(){
    var curPage = $.cookie("curPage");
    $.post("dealFuns/fetchPageData.php",{curPage:curPage},function(data){
        $("#showUsers").html(data);
    });
}
