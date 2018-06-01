/* POSITION ELEMENTS*/

function init (){    
        if ($(window).width()>=980) {
           $(".cover-image").attr("style","padding-top:"+($('.menu-container').outerHeight()+0)+"px;");
           $(".menu-container").show();
        }
        else {
            $(".cover-image").attr("style","padding-top:"+($('.menu-toggle').outerHeight()+0)+"px;");
        }
        
        $(".main").attr("style","margin-top:"+$('.cover-image').outerHeight()+"px;");
       
        if ($(".sidebar").length > 0) {

            if ($(window).width()>=980) {
                $(".sidebar").attr("style","margin-top:"+$('.cover-image').outerHeight()+"px; min-height:"+$(".main").height()+"px;");
            } else {
                $(".sidebar").removeAttr("style");
            }
         }
    
}

/* FADE COVER PHOTO IN AND OUT ON SCROLL*/

$(document).scroll(function() {
    if ($(this).scrollTop() >= 50) {
        $( ".cover-image" ).addClass("faded");
        $( ".cover-image" ).removeClass("fade-in");
    }
    
    if($(this).scrollTop() < 50)  {        
       $( ".cover-image" ).removeClass( "faded");
       $( ".cover-image" ).addClass("fade-in");
    }
});

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
   
    var url = window.location.href; 

/* ADD CURRENT LINK ATTRIBUTE TO <LI>*/
    $(".main-nav a").each(function() {
        if(url == (this.href)) { 
            $(this).closest("li").attr("style","border-bottom:2px solid #006FA0;");
            console.log(url);
        }
    });
});