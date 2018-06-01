/* POSITION ELEMENTS*/
function init (){    
        if ($(window).width()>=980) {
                $(".menu-container").show();
                $(".main").attr("style","margin-top:"+$('.menu-container').outerHeight()+"px;");
                if ($(".sidebar").length > 0) {
                        $(".sidebar").attr("style","margin-top:"+$('.menu-container').outerHeight()+"px;");
                        
                }
        } else {
                $(".sidebar").removeAttr("style");
                $(".main").attr("style","margin-top:"+$('.menu-toggle').outerHeight()+"px;");
                
        }
}



$(window).load(function(){    
    init();
    
    $("#load").fadeTo("slow",0,function(){
        $("#load").hide();
    });    
});

/* POSITION ELEMENTS AGAIN ON RESIZE*/

$( window ).resize(function() {
        init();
});

$(document).ready(function(){
    if ($(".sidebar").length==0) {
        $(".main").attr("id","main-fullwidth");
    } else {
    
        if ($(".sidebar").height()>$(".main").height()) {
            var h=$(".sidebar").height();
        }
        else {
            var h=$(".main").height();
        }
    }
    
    $("#load").attr("style","top:"+($('.header').outerHeight()+50)+"px;height:"+h+"px;");
    
    $(".menu-toggle").click(function(){
        $(".menu-container").toggle("slide");
    });
   
    /* ADD CURRENT LINK ATTRIBUTE TO <LI>*/
    var url = window.location.href; 


    $(".main-nav a").each(function() {
        if(url == (this.href)) { 
            $(this).closest("li").attr("style","border-bottom:2px solid #006FA0;");
        }
    });
});