

var fadeinoutcrawl = function () {
    $.get('<?php echo LOGIN_URL; ?>/configuration/changeencoding?id=' + $('#encode_from').val(), function(data) {
                 
                   $('#change_encoding_div').fadeOut();
                   $('#search_form').fadeOut();
                   $('#error_display').fadeOut();
                   $('#crawl').fadeIn();
                   $.get('<?php echo LOGIN_URL; ?>/configuration/crawl?id=<? echo $vars->wid; ?>', function(data){
                       if(data == 'true'){
                          $('.search').click();
                       } else {
                       
                           $('#crawl').fadeOut();
                           
                           $('#content').fadeIn();
                           $('#error_display').html(data);      
                            $('#error_display').fadeIn();   
                           
                       }
                       
                   });
                   
               });
           }
           
           
 var fadeinoutcrawlstatus = function () {
       $('#normal-content').fadeOut();
       $('#error_display').fadeOut();
       $('#crawl-content').fadeIn();
      
       $.get('<?php echo LOGIN_URL; ?>/configuration/crawl?id=<? echo $vars->wid; ?>', function(data){
           
           if(data == 'true'){
               $('#crawl-content').fadeOut();
               $('h1.signup').html('Succes');
               $('#normal-content').html('<p class="center"><h1><?php __('Succes'); ?></h1><?php __('Du kan nu gå videre ved tryk på "Næste"-knappen nedenfor.'); ?></p><a class="next" href="<?php echo LOGIN_URL; ?>/configuration/next">Videre</a>');
               $('#normal-content').fadeIn();
               
           } else {
           
               $('#crawl-content').fadeOut();
               $('#normal-content').fadeIn();
                
               $('#error_display').html(data);      
               $('#error_display').fadeIn();          
           }
           
       });
                   
            
 } 
   
$(function() {
         $('#emailme-btn').click(function (){
               $.get('<?php echo LOGIN_URL; ?>/configuration/emailme', function(data) {
                 
                   $('#emailme-div').hide();
                   $('#emailmealready-div').show();
               });
           });
        $('.wtype').click(function (){
            var id = this.id;
            $.get('<?php echo LOGIN_URL; ?>/configuration/getsetwebshoptype?id=' + id, function(data) {
                if(!$('#'+id).hasClass('picked')){
                    
                    $('.picked_info').hide();
         
                    $('.picked_info').removeClass('picked_info');
                    
                    $('.picked').removeClass('picked');
                    $('#'+id).addClass('picked');
                    $('#'+id+'_info').addClass('picked_info');
                    
                    $('#hostname_div').fadeIn();
                    $('#'+id+'_info').fadeIn();
                } 
            });
         
        }); 
        $('.magento').click();
        $('#change_encoding_a').click(function (){
        
       
       
           $('#change_encoding_div').show(); 
           $('#search_form').append('<input type="hidden" name="display_encode">');
           $('#change_layout').click(fadeinoutcrawl);
        });
        
       $('#change_layout').click(fadeinoutcrawl);
       $('#fetch_now').click(fadeinoutcrawlstatus);
       if($('#output_format').val() != 'html') {
			$('#template_view').hide();       	
       }
       
       $('#output_format').change(function() {
     	 	$.get('<?php echo LOGIN_URL; ?>/configuration/templateset?output_format='+$('#output_format').val(), function(data) {
				if($('#output_format').val() != 'html') {
					$('#template_view').fadeOut();	
				}
				else {
					$('#template_view').fadeIn();		
				}
       	});       	
       });
       
       <?php
       	if(!Template::aTemplateWasEverChosen($vars->wid)) {
     	 ?>
     	 $.get('<?php echo LOGIN_URL; ?>/configuration/templateset?template=1', function(data) {
			location.href = '<?php echo LOGIN_URL; ?>';
       });
     	 <?php	
       	}
       ?>
       
       
  
   
});

