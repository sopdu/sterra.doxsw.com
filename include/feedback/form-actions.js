/* JavaScript Document

Валидация и блокировка кнопки отправки формы
*/

function checkParams() {
    var fioform = $('#valid-usr').val();
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
    var dateform = $('#valid-dat').val();
    var select1 = feedback.case.selectedIndex;
    var select2 = feedback.dep.selectedIndex;
    var processing = $('#codabra-processing');
    var gresponse = grecaptcha.getResponse();
    if(gresponse.length > 0 && fioform.length != '0' && email_correct && orgform.length != '0' && dateform.length != '0' && select1 != '0' && select2 != '0' && processing.prop('checked')) {
        $('#submit-button').removeAttr('disabled');
    } else {
        $('#submit-button').attr('disabled', 'disabled');
    }
}

function checkParamsForPartnersForm() {
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
    var gresponse = grecaptcha.getResponse();
    var fsbfile = false;
    if ($('#fsbFile').val() != ''){
      fsbfile = true;
    }

    if(gresponse.length > 0 && fioform.length != '0' && email_correct && orgform.length != '0' && ser.length != '0' && phone.length != '0' && fsbfile) {
        $('#submit-button').removeAttr('disabled');
    } else {
        $('#submit-button').attr('disabled', 'disabled');
    }
}

//Скрытие/отображение полей "Другая причина"
$(document).ready(function() {
  $.viewInput = {
    '0' : $([]),
    'OtherCase' : $('#OtherCase'),
  };

$('#case').change(function() {
    $.each($.viewInput, function() { this.hide(); });
    $.viewInput[$(this).val()].show();
  });

});


//Блок отключения стилера на select
(function($) {
$(function() {

  $('select').styler('destroy');
  $('.codabra-elements').styler('destroy');

});
})(jQuery);

//Блок изменяющегося меню
function izmen(){
chto=document.getElementById("case").value;
if(chto=="Необходимость в техподдержке"){
document.feedback.dep.options.length=0;
document.feedback.dep.options[0]=new Option("Выбрать подразделение", '0', false, false);
document.feedback.dep.options[1]=new Option("Отдел продаж", "Отдел продаж", false, false);
document.feedback.dep.options[2]=new Option("Технический консалтинг", "Технический консалтинг", false, false);
document.feedback.dep.options[3]=new Option("Техническая поддержка", "Техническая поддержка", true, true);
document.feedback.dep.options[4]=new Option("Отдел логистики", "Отдел логистики", false, false);
}
if(chto=="Консультация по выбору продукта"){
document.feedback.dep.options.length=0;
document.feedback.dep.options[0]=new Option("Выбрать подразделение", '0', false, false);
document.feedback.dep.options[1]=new Option("Отдел продаж", "Отдел продаж", false, false);
document.feedback.dep.options[2]=new Option("Технический консалтинг", "Технический консалтинг", true, true);
document.feedback.dep.options[3]=new Option("Техническая поддержка", "Техническая поддержка", false, false);
document.feedback.dep.options[4]=new Option("Отдел логистики", "Отдел логистики", false, false);
}
if(chto=="Вопросы применения продукта"){
document.feedback.dep.options.length=0;
document.feedback.dep.options[0]=new Option("Выбрать подразделение", '0', false, false);
document.feedback.dep.options[1]=new Option("Отдел продаж", "Отдел продаж", false, false);
document.feedback.dep.options[2]=new Option("Технический консалтинг", "Технический консалтинг", true, true);
document.feedback.dep.options[3]=new Option("Техническая поддержка", "Техническая поддержка", false, false);
document.feedback.dep.options[4]=new Option("Отдел логистики", "Отдел логистики", false, false);
}
if(chto=="Запрос коммерческого предложения"){
document.feedback.dep.options.length=0;
document.feedback.dep.options[0]=new Option("Выбрать подразделение", '0', false, false);
document.feedback.dep.options[1]=new Option("Отдел продаж", "Отдел продаж", true, true);
document.feedback.dep.options[2]=new Option("Технический консалтинг", "Технический консалтинг", false, false);
document.feedback.dep.options[3]=new Option("Техническая поддержка", "Техническая поддержка", false, false);
document.feedback.dep.options[4]=new Option("Отдел логистики", "Отдел логистики", false, false);
}
if(chto=="OtherCase"){
document.feedback.dep.options.length=0;
document.feedback.dep.options[0]=new Option("Выбрать подразделение", '0', true, true);
document.feedback.dep.options[1]=new Option("Отдел продаж", "Отдел продаж", false, false);
document.feedback.dep.options[2]=new Option("Технический консалтинг", "Технический консалтинг", false, false);
document.feedback.dep.options[3]=new Option("Техническая поддержка", "Техническая поддержка", false, false);
document.feedback.dep.options[4]=new Option("Отдел логистики", "Отдел логистики", false, false);
}

}
