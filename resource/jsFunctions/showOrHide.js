function showOrHide(id) {
    var tardiv = $("#"+id);
    if(tardiv.css("display")=="none"){
        tardiv.css("display","block");
    }else{
        tardiv.css("display","none");
    }
}