$(document).ready(function(){
	
	var id = window.location.hash;	
	che = id.slice(0, 3);

	if(id != "" && che == "#id"){
		
		id = id.replace("#id","");
	
		
	
		$('.search-dom').each(function(e){
			
			var anchor = $(this).attr("href").replace("#","");
			var s = $(this).attr("class").replace("search-dom ","");
			
			
			if(anchor == id){
				$(this).parent().css("display", "block");
				
				$('.tab').each(function(i){
					
					if(s == $(this).attr('id')){
						
						$(this).addClass("current");
					}else{
						
						$(this).removeClass("current");
					}
				});
			}else{
				
				$(this).parent().css("display", "none");
			}
				
		});
	}
	
	$(".box").each(function(i){
		if(i == 0){
			$(this).addClass('visible');
		}			
	});	
});