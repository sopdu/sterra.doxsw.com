/* JavaScript Document

Валидация и блокировка кнопки отправки формы
*/

function checkParams() {
    var fioform = $('#valid-lic').val();
    var email_correct = false;
    if($('#email').val() != '') {  
      var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
      if(pattern.test($('#email').val())){
        $('#email').removeClass('modalvalid');
        $('#email').parent().find('.error').addClass('invis');
        $('#email').parent().find('.mesage').removeClass('invis');
        email_correct = true;
      }else{
        $('#email').addClass('modalvalid');
        $('#email').parent().find('.mesage').addClass('invis');
        $('#email').parent().find('.error').removeClass('invis');
      }
    }
    var orgform = $('#valid-org').val();
    var ser = $('#valid-ser').val();
    var phone = $('#phone').val();
    var processing = false;
	var proccessingElements = document.getElementsByClassName('codabra-elements');
	if (proccessingElements[0].checked)
		processing=true;

    var gresponse = grecaptcha.getResponse();
	if ( $( "#fsbFile" ).length ){
	    var fsbfile = false;
    	if ($('#fsbFile').val() != ''){
      		fsbfile = true;
    	}
	}else
		fsbfile = true;

    if(gresponse.length > 0 && fioform.length != '0' && email_correct && orgform.length != '0' && ser.length != '0' && phone.length != '0' && fsbfile && processing) {
        $('#submit-bp-button').removeAttr('disabled');
    } else {
        $('#submit-bp-button').attr('disabled', 'disabled');
    }
}


