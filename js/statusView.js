
   
$(function() {
     var delay_millis = 15000;
    
 
   
    var repeatHandle = window.setInterval(function() {
       $.get($('#loginurl').html()+'/configuration/iscrawled/?id='+ $('#wid').html(), function(data) {
        
           if(data == 'okay'){
               window.location.href = $('#loginurl').html();
           }
           
        })
    }, delay_millis);
      
   
});