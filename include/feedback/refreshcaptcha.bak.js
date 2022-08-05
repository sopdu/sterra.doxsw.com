$(document).ready(function() {
    $('#refresh_captcha').click(function(){
        $.get('/include/ajax/feedback.php?action=getcaptcha', function(data) {
            $('#captcha_img').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captcha_sid').val(data);
        });
        return false;
    });
})

$(document).ready(function() {
    $('#form').on('submit',function(event){
        event.preventDefault ();
        event.stopImmediatePropagation ();

        var sid = $('#captcha_sid').val();
        var word = $('#captcha_word').val();
        var post_data = $('#form').serialize();
        $.post("/include/ajax/feedback.php?action=submit", post_data, function(data){
            if(data.length>0){
                if (data === "submitted"){
                    alert("Спасибо за ваш отзыв!");
                    location.reload();
                }
                else if (data === "wrong_captcha"){
                    document.getElementById("captcha_word").classList.add('modalvalid');
                    document.getElementById("captcha_label").innerHTML = "Введите текст с картинки еще раз";
                    $.get('/include/ajax/feedback.php?action=getcaptcha', function(data) {
                        $('#captcha_img').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
                        $('#captcha_sid').val(data);
                    });
                }
            }
        });
        return false;
    });
});

