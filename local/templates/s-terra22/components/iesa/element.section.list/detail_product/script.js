$(document).ready(function(){
	$(".open_text").each(function(i){	
		
		$(this).click(function(){
			
			$(this).siblings('.show').slideToggle();
			return false;
		});
	})
	
	$(".open_text_cer").each(function(i){	
		
		$(this).click(function(){
			
			$(this).siblings('.show_text').slideToggle();
			return false;
		});
	})
	
	
});