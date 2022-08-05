/* JavaScript Document

Валидация и блокировка кнопки отправки формы
*/

function checkParams() {
    var fioform = $('#valid-usr').val();
    var emailform = $('#email').val();
    var orgform = $('#valid-org').val();
    var dateform = $('#valid-dat').val();
    var select1 = feedback.case.selectedIndex;
    var select2 = feedback.dep.selectedIndex;
    var processing = $('#codabra-processing');
    if( fioform.length != '0' && emailform.length != '0' && orgform.length != '0' && dateform.length != '0' && select1 != '0' && select2 != '0' && processing.prop('checked')) {
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
