$( document ).ready(function() {
    $("#phone").mask("+7 (999) 999-99-99");
    $("#sphonenumber").mask("+7 (999) 999-99-99");
	$('#form').submit(function(){		
		var error=0;
		$('#form .need-valid').each(function(i){
		
			var val = $(this).val();
			
			if(!val.length > 0){
				$(this).addClass('modalvalid');
				$(this).parent().find('.mesage').addClass('invis');
				$(this).parent().find('.error').removeClass('invis');
				error++;
			}else{
				$(this).removeClass('modalvalid');
				$(this).parent().find('.error').addClass('invis');
				$(this).parent().find('.mesage').removeClass('invis');				
			}
		});
		
		
		if($('#email').val() != '') {
			
			var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
				
			if(pattern.test($('#email').val())){
				$('#email').removeClass('modalvalid');
				$('#email').parent().find('.error').addClass('invis');
				$('#email').parent().find('.mesage').removeClass('invis');					
			}else{
				$('#email').addClass('modalvalid');
				$('#email').parent().find('.mesage').addClass('invis');
				$('#email').parent().find('.error').removeClass('invis');
				error++;
			}
		}
		
		
		if($('#phone').val() == ''){
			error++;
		}
		if(error>0)
			return false;
		else 
			return true;
	});
	
	$("#form .need-valid").keypress(function(){
		$(this).removeClass('modalvalid');
		$(this).parent().find('.error').addClass('invis');
		$(this).parent().find('.mesage').removeClass('invis');		
	});

	$('#bp-form').submit(function(){		
		var error=0;
		$('#bp-form .need-valid').each(function(i){
		
			var val = $(this).val();
			
			if(!val.length > 0){
				$(this).addClass('modalvalid');
				$(this).parent().find('.mesage').addClass('invis');
				$(this).parent().find('.error').removeClass('invis');
				error++;
			}else{
				$(this).removeClass('modalvalid');
				$(this).parent().find('.error').addClass('invis');
				$(this).parent().find('.mesage').removeClass('invis');				
			}
		});
		
		
		if($('#email').val() != '') {
			
			var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
				
			if(pattern.test($('#email').val())){
				$('#email').removeClass('modalvalid');
				$('#email').parent().find('.error').addClass('invis');
				$('#email').parent().find('.mesage').removeClass('invis');					
			}else{
				$('#email').addClass('modalvalid');
				$('#email').parent().find('.mesage').addClass('invis');
				$('#email').parent().find('.error').removeClass('invis');
				error++;
			}
		}
		
		
		if($('#phone').val() == ''){
			error++;
		}
		if(error>0)
			return false;
		else 
			return true;
	});
	
	$("#bp-form .need-valid").keypress(function(){
		$(this).removeClass('modalvalid');
		$(this).parent().find('.error').addClass('invis');
		$(this).parent().find('.mesage').removeClass('invis');		
	});


});