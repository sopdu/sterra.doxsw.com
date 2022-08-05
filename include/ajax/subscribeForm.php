<script>
	jQuery(document).ready(function() {

		jQuery.get('/include/ajax/checkSubscribe.php')
		.done(function(msg) {
			if (msg==1) {
				jQuery('.codabra-form').hide();
				jQuery('.codabra-thanks').show();
			}
		});

		jQuery('#addSubscribe').on('click', function() {
			var $name = jQuery(this).parent().find('input[name="name"]');
			var $email = jQuery(this).parent().find('input[name="email"]');
			
			if ($name.val().length>0 && $email.val().length>0) {

				var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
				if(pattern.test($email.val())){
					jQuery.post('/include/ajax/addSubscribe.php', {name: $name.val(), email: $email.val()})
					.done(function(msg) {
						msg = jQuery.parseJSON(msg);
						if (msg.status>0) {
							// alert(msg.message);
							jQuery('.codabra-form').hide();
							jQuery('#codabra-thanks-text').text('Вы успешно подписались на рассылку.');
							jQuery('.codabra-thanks').show();
						}
						else {
							jQuery('.codabra-form').hide();
							jQuery('#codabra-thanks-text').text(msg.message);
							jQuery('.codabra-thanks').show();
						}
					});
				} else {
					jQuery('.error.codabra-form-email').show();
					jQuery('.codabra-form').css('padding-top', 0);
				}
			} else {
				if($name.val().length==0) {
					jQuery('.error.codabra-form-name').show();
				}
				if($email.val().length==0) {
					jQuery('.error.codabra-form-email').show();
				}
				jQuery('.codabra-form').css('padding-top', 0);
			}
			return false;
		});

		jQuery('.codabra-form').on('click', function() {
			jQuery('.codabra-form .error').hide();
			jQuery('.codabra-form').css('padding-top', '18px');
		});
	});
</script>
<div class="codabra-form-wrapper">
		<div class="title_one_third soft-blue">
			<h3>Подписка на новости</h3>
		</div>
		<section class="news-block">
			<div>
				<div class="ads one_third" style="background-color:#f2f2f2;">
					<div class="ads-text codabra-form">
						<form action="" class="pageform">
							<p><input type="text" name="name" class="codabra-form-input" value="" placeholder="Ваше имя"></p>
							<p class="error codabra-form-name" style="font-size: 11px;">Имя не может быть пустым</p>
							<p><input type="text" name="email" class="codabra-form-input" value="" placeholder="Ваш e-mail"></p>
							<p class="error codabra-form-email" style="font-size: 11px;">Введите e-mail в формате myemail@gmail.com</p>
							<input type="submit" id="addSubscribe" class="codabra-form-input-submit" value="Подписаться">
							<div class="subscribeRound round-button right icon-arrow-next" style="margin-top:10px;"></div>
						</form>
					</div>
					<div class="ads-text codabra-thanks" style="text-align: center; padding-top: 30px;">
						<p style="text-align: center; font-size: 13px; color: #A9A9A9;" id="codabra-thanks-text">Вы успешно подписались на рассылку. </p>
						<p style="text-align: center; font-size: 13px; color: #A9A9A9;">Спасибо, что Вы с нами.</p>
						<img src="/img/letter.png" alt="">
					</div>
				</div>
			</div>
		</section>
</div>
<div class="clearfix"></div>