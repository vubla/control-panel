$(function() {
	
	function preview() {
		//#vubla
		if($(this).attr('name') == 'Font_Stack[]') {
			$('#vbl-serp').css('font-family',$(this).val());	
		}
		
		if($(this).attr('name') == 'Text_Color[]') {
			$('#vubla').css('color',$(this).val());	
		}
		
		//Primary Color
		if($(this).attr('name') == 'Primary_Color[]') {
			$('#vbl-search-results-header').css('background',$(this).val());
		}
		
		//Secondary Color
		if($(this).attr('name') == 'Secondary_Color[]') {
			$('#vbl-search-results-header').css('border-color',$(this).val());
			$('#vbl-product-list li').css('border-color',$(this).val()); //TEMPLATE ID 1
			$('#vbl-product-list').css('border-color',$(this).val()); //TEMPLATE ID 2
		}
		
		//Font Size
		if($(this).attr('name') == 'Font_Size[]') {
			var ninepx = (9*($(this).val()/100)+9)+'px';
			var tenpx = (10*($(this).val()/100)+10)+'px';
			var twelvepx = (12*($(this).val()/100)+12)+'px';
			var fifteenpx = (15*($(this).val()/100)+15)+'px';
			
			$('#vbl-search-results-header').css('font-size',twelvepx);
			$('#vbl-product-list').css('font-size',twelvepx);	
			$('.vbl-product-name').css('font-size',fifteenpx);	
			$('.vbl-product-discounted').css('font-size',tenpx);	
			$('.vbl-product-discount').css('font-size',twelvepx);
			$('.vbl-product-description').css('font-size',ninepx);
		}
		
		//Links
		if($(this).attr('name') == 'Link_Color[]') {
			$('#vbl-product-list a:link').css('color',$(this).val());
		}
		if($(this).attr('name') == 'Visited_Link_Color[]') {
			$('#vbl-product-list a:visited').css('color',$(this).val());	
		}
		if($(this).attr('name') == 'Focused_Link_Color[]') {
			$('#vbl-product-list a:hover').css('color',$(this).val());
			$('#vbl-product-list a:active').css('color',$(this).val());
		}
		
		//Buttons
		if($(this).attr('name') == 'More_Info_Button[]') {
			if($(this).val().toLowerCase().indexOf("http://") >= 0) {
				
				$('body').append('<img id="tmpImg" src="' + $(this).val() + '" />');
				var height = $('#tmpImg').height();
				var width = $('#tmpImg').width();
				$('#tmpImg').remove();	

				$('.vbl-more-info-button').css('height',height+'px');
				$('.vbl-more-info-button').css('width',width+'px');
				$('.vbl-more-info-button').css('background','none');
				$('.vbl-more-info-button').html('<img src="'+$(this).val()+'" alt="Mere info" />');
				$('.vbl-more-info-button').children().height(height);
				$('.vbl-more-info-button').children().width(width);				
			}
			else {
				$('.vbl-more-info-button').css('background','url("<?php echo API_URL; ?>/images/btn_info_'+$(this).val()+'.png")');
			}
		}
		
		if($(this).attr('name') == 'Buy_Now_Button[]') {
			if($(this).val().toLowerCase().indexOf("http://") >= 0) {
				
				$('body').append('<img id="tmpImg" src="' + $(this).val() + '" />');
				var height = $('#tmpImg').height();
				var width = $('#tmpImg').width();
				$('#tmpImg').remove();	

				$('.vbl-buy-now-button').css('height',height+'px');
				$('.vbl-buy-now-button').css('width',width+'px');
				$('.vbl-buy-now-button').css('background','none');
				$('.vbl-buy-now-button').html('<img src="'+$(this).val()+'" alt="Læg i kurv" />');
				$('.vbl-buy-now-button').children().height(height);
				$('.vbl-buy-now-button').children().width(width);		
			}
			else {
				$('.vbl-buy-now-button').css('background','url("<?php echo API_URL; ?>/images/btn_buy_'+$(this).val()+'.png")');
				$('.vbl-buy-now-button:hover').css('background-position','-71px 0px');
			}
		}
	}
	
	$('.set_template').click(function() {
		var current_view = '<?php echo $this->view; ?>';

		if(current_view == 'views/confstep_templateView.php') {
			var controller = 'configuration';
			var link = '<?php echo LOGIN_URL; ?>';
		}
		else if(current_view == 'views/editsearchlayoutView.php') {
			var controller = 'searchlayout';
			var link = '<?php echo LOGIN_URL; ?>/searchlayout/edit';
		}

		$.get('<?php echo LOGIN_URL; ?>/'+controller+'/templateset?template=' + $(this).attr('id'), function(data) {
			location.href = link;
		});
	});
	
	$('.change_value').change(preview);
	
	$('.custom_value').keyup(preview);
	
});

