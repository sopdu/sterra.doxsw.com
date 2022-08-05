<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
		<!-- FOOTER -->
		<div class="top-button">
			<div class="container">
				<button class="btn btn-primary-inverse btn-round" hidden type="button">
					<svg width="14" height="14">
						<use xlink:href="#i-arrow-top" href="#i-arrow-top"></use>
					</svg>
				</button>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="footer__logo col col-12"><a class="footer-logo" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo-white.png" alt="S-Terra logo"></a></div>
					<div class="footer__data col col-12 col-sm-8">
						<div class="row">
							<div class="col col-12 col-xs-6">
								<div class="footer-contacts">
									<div class="footer-contacts__title">Контакты</div>
									<p><b>Офис:</b><br>124460  г. Зеленоград, ул. Конструктора Лукина, д. 14, стр. 12, Технополис Москва</p>
									<p>Телефон/факс:<br><a href="tel: 84999409061"><b>8 (499) 940-90-61</b></a></p>
									<p>Почта<br><a href="mailto:information@s-terra.ru"><b>information@s-terra.ru</b></a></p>
								</div>
							</div>
							<div class="col col-12 col-xs-6">
								<div class="footer-apps">
                                    <div class="apps colored">
                                        <?
                                        $iblock = 70;
                                        $socialDB = CIBlockElement::GetList(
                                            Array('SORT' => 'ASC'),
                                            Array('IBLOCK_ID' => $iblock),
                                            false,
                                            false,
                                            Array('ID')
                                        );
                                        $socialSettings = $socialDB->Fetch();
                                        $res = CIBlockElement::GetProperty($iblock, $socialSettings['ID']);
                                        while ($ob = $res->GetNext()) $socialSettings['PROPERTIES'][$ob['CODE']] = $ob;
                                        if ($socialSettings['PROPERTIES']['TG']['VALUE'] || $socialSettings['PROPERTIES']['WA']['VALUE']):
                                            ?>
                                            <div class="apps-block">
                                                <div class="apps-title">Мы в мессенджерах</div>
                                                <ul class="apps-list">
                                                    <?if ($socialSettings['PROPERTIES']['WA']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-wa" href="<?=$socialSettings['PROPERTIES']['WA']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/wa.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/wa-color.png"></a></li>
                                                    <?endif;?>

                                                    <?if ($socialSettings['PROPERTIES']['TG']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-tg" href="<?=$socialSettings['PROPERTIES']['TG']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/tg.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/tg-color.png"></a></li>
                                                    <?endif?>
                                                </ul>
                                            </div>
                                        <?endif?>
                                        <?if ($socialSettings['PROPERTIES']['FB']['VALUE'] || $socialSettings['PROPERTIES']['YT']['VALUE'] || $socialSettings['PROPERTIES']['VK']['VALUE'] || $socialSettings['PROPERTIES']['FB']['VALUE']):?>
                                            <div class="apps-block">
                                                <div class="apps-title">Мы в соцсетях</div>
                                                <ul class="apps-list">
                                                    <?if($socialSettings['PROPERTIES']['FB']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-fb" href="<?=$socialSettings['PROPERTIES']['FB']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/fb.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/fb-color.png"></a></li>
                                                    <?endif?>

                                                    <?if($socialSettings['PROPERTIES']['YT']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-yt" href="<?=$socialSettings['PROPERTIES']['YT']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/yt.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/yt-color.png"></a></li>
                                                    <?endif?>

                                                    <?if($socialSettings['PROPERTIES']['VK']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-vk" href="<?=$socialSettings['PROPERTIES']['VK']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/vk.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/vk-color.png"></a></li>
                                                    <?endif?>

                                                    <?if($socialSettings['PROPERTIES']['IG']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-in" href="<?=$socialSettings['PROPERTIES']['IG']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/in.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/in-color.png"></a></li>
                                                    <?endif?>

                                                    <?if($socialSettings['PROPERTIES']['RU']['VALUE']):?>
                                                        <li><a class="app-icon app-icon-in" href="<?=$socialSettings['PROPERTIES']['RU']['VALUE']?>" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/ru-color.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/ru.png"></a></li>
                                                    <?endif?>
                                                </ul>
                                            </div>
                                        <?endif;?>
                                    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer__links col col-12 col-sm-4">
						<div class="row">
							<div class="col col-12 col-xs-8 col-sm-12"><a class="footer-logo"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo-white.png" alt="S-Terra logo"></a><a class="footer-link" href="/info-warning.php">Предупреждение об информации на сайте</a><a class="footer-link" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf" target="_blank">Политика обработки персональных данных ООО «С&#8209;Терра СиЭсПи»</a>
								<div class="footer-copyright">© ООО «С&#8209;Терра СиЭсПи», <?=date("Y")?><br>Все права защищены.</div>
							</div>
						</div>
					</div>
					<div class="footer__column footer-menu"></div>
				</div>
			</div>
		</footer><!-- /FOOTER -->
		</div>
		<div class="modal" id="success-modal" tabindex="-1" role="dialog" hidden>
			<div class="modal-container" role="document">
				<div class="modal-window">
					<button class="icon-btn modal-close" type="button" data-dissmiss="modal" arial-label="Close"><span class="color-primary" aria-hidden="true">
		                      <svg width="20" height="20">
		                        <use xlink:href="#i-times" href="#i-times"></use>
		                      </svg></span></button>
					<div class="modal-body">
						<div>Информация успешно отправлена. Мы свяжемся с вами в ближайшее время.</div>
					</div>
				</div>
			</div>
		</div>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	<!-- Background of PhotoSwipe.
		 It's a separate element as animating opacity is faster than rgba(). -->
	<div class="pswp__bg"></div>

	<!-- Slides wrapper with overflow:hidden. -->
	<div class="pswp__scroll-wrap">

		<!-- Container that holds slides.
			PhotoSwipe keeps only 3 of them in the DOM to save memory.
			Don't modify these 3 pswp__item elements, data is added later on. -->
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>

		<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
		<div class="pswp__ui pswp__ui--hidden">

			<div class="pswp__top-bar">

				<!--  Controls are self-explanatory. Order can be changed. -->

				<div class="pswp__counter"></div>

				<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

				<button class="pswp__button pswp__button--share" title="Share"></button>

				<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

				<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
				<!-- element will get class pswp__preloader--active when preloader is running -->
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>

			<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
			</button>

			<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
			</button>

			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>

		</div>

	</div>

</div>
	</body>
</html>