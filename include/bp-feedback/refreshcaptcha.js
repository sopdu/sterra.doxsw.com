$(document).ready(function() {
    $('#bp-form').on('submit',function(event){
        event.preventDefault ();
        event.stopImmediatePropagation ();

        var post_data = $('#bp-form').serialize();
$.ajax({
  async: false,
  cache: false
});
        $.post("/include/ajax/bp_feedback.php?action=submit", post_data, function(data){
            if(data.length>0){
                if (data === "submitted"){
                    alert("Ваша заявка отправлена. Спасибо!");
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

