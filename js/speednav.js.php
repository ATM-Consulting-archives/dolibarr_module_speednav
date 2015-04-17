<?php

    require('../config.php');
    
?>

var TNoLink=[
    "admin/modules.php"
];

$(document).ready(function() {
   
   initLink("div.tmenudiv ul.tmenu a, div#id-left div.vmenu a");
   initPopin("div.fiche div.tabs div.tabsElem a:not(:first)");
    
});
function initPopin(onWhat) {
    
   
    $(onWhat).each(function(i) {
       
         var url = $(this).attr("href"); 
         $(this).attr("href","javascript:;");
         $(this).attr("ajax-url", url);
         
        $(this).click(function(event) {
                var url = $(this).attr("ajax-url");
                var title = $(this).text();
                
                $("#popin-full-screen-tab").remove();
                $("body").append('<div id="popin-full-screen-tab"></div>' );
                
                $( "div#popin-full-screen-tab" ).load( url+ " div#id-container div.fiche", function( response, status, xhr ) {
                    
                    if(response=="") {
                        document.location.href = url;
                    }
                    else {
                       $( "div#popin-full-screen-tab div.tabs" ).remove();
                       $( "div#popin-full-screen-tab" ).dialog({
                          dialogClass: "fulldialog"
                          ,modal:false
                          ,width:"80%"
                          ,title:title
                          
                        });
                       
                    }
             
                });
                
           });    
            
    });
}
function initLink(onWhat) {
   
   $(onWhat).each(function(i) {
       
       var url = $(this).attr("href");
       
       if(!isForbiddenLink(url)) {
               
           $(this).attr("href","javascript:;");
           $(this).attr("ajax-url", url);
            
           $(this).click(function(event) {
                var url = $(this).attr("ajax-url");
                
                if($("div#id-container-master").length==0) {
                    $("div#id-container").wrap( "<div id=\"id-container-master\" style=\"width:100%;\"></div>" );
                }
                
             //   $( "div#id-container-master" ).css({ opacity:0.2 });
                $( "div#id-container-master" ).load( url+ " div#id-container", function( response, status, xhr ) {
                    
                    if(response=="") {
                        document.location.href = url;
                    }
                    else {
                //       $( "div#id-container-master" ).css({ opacity:1 });
                       initLink("div#id-left div.vmenu a");
                    }
             
                });
                
           });          
       } 
       

   
   });
     
    
    
}

function isForbiddenLink(url) {
    
    for(i in TNoLink) {
        if(url.indexOf(TNoLink[i])>-1 ) {
            console.log(url, TNoLink[i]);
            return true;
            
         }
    }
    return false;
}