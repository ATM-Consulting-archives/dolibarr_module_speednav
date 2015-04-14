<?php

    require('../config.php');
    
?>
$(document).ready(function() {
   
   initLink();
   
    
});

function initLink(onWhat) {
   
   if(onWhat==null){ onWhat="div.tmenudiv ul.tmenu a, div#id-left div.vmenu a";}
   
   $(onWhat).each(function(i) {
       
       var url = $(this).attr("href");
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
   
   });
     
    
    
}
