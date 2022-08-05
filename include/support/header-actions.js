$(document).ready(function(){
	let offerTitle = $('.offer-name');
	let name = $('#offer-name').val(); 
	let link = $('#offer-link').val(); 

	offerTitle.text(name);
	offerTitle.attr('href', link);
})