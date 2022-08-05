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
	
	let formButton = $(".zaprosZayvki").find('a');
	if (formButton.length>0){
		let newRef = formButton.attr('href') + "?offer=" + $('.href-info').text() +"&name=" + encodeURIComponent($('.href-name').text());
		formButton.attr('href', newRef);
	}
});