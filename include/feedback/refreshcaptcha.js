$(document).ready(function() {
    $('#form').on('submit',function(event){
        event.preventDefault ();
        event.stopImmediatePropagation ();

        var post_data = $('#form').serialize();
        $.post("/include/ajax/feedback.php?action=submit", post_data, function(data){
            if(data.length>0){
                if (data === "submitted"){
                    alert("Спасибо за ваш отзыв!");
                    location.reload();
                }
                else if (data === "wrong_captcha"){
                    alert('Wrong captcha!');
                    grecaptcha.reset()
                }
            }
        });
        return false;
    });
});

