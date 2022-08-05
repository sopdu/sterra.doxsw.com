/* JavaScript Document

Валидация и блокировка кнопки отправки формы
*/

function checkParams() {
    var fioform = $('#ssurnamename').val();
    var email_correct = false;
    if($('#semail-from').val() != '') { 
      /* 
      var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
      */
      var pattern = /^([a-z0-9_\.-])+@([a-z0-9-]+\.)+[a-z]{2,4}$/i;
      if(pattern.test($('#semail-from').val())){
        $('#semail-from').removeClass('modalvalid');
        $('#semail-from').parent().find('.error').addClass('invis');
        $('#semail-from').parent().find('.mesage').removeClass('invis');
        email_correct = true;
      }else{
        $('#semail-from').addClass('modalvalid');
        $('#semail-from').parent().find('.mesage').addClass('invis');
        $('#semail-from').parent().find('.error').removeClass('invis');
      }
    }
    var orgform = $('#sorgname').val();
    var ser = $('#sposemp').val();
	var slic = $('#slicensenumber').val();
    var phone = $('#sphonenumber').val();
    var processing = false;
	var proccessingElements = document.getElementsByClassName('codabra-elements');
	if (proccessingElements[0].checked)
		processing=true;
    var gresponse = grecaptcha.getResponse();
    if(gresponse.length > 0 && fioform.length != '0' && email_correct && orgform.length != '0' && ser.length != '0' && slic.length != '0' && phone.length != '0' && processing) {
        $('#submit').removeAttr('disabled');
    } else {
        $('#submit').attr('disabled', 'disabled');
    }
 }


