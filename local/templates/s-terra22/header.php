<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\UI\Extension;

Loc::loadMessages(__FILE__);

$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH.'/plugins/photoswipe/photoswipe.css');
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH.'/plugins/photoswipe/default-skin/default-skin.css');
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH.'/plugins/TinySlider/tiny-slider.css');
$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH.'/plugins/datepicker.css');


$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/typographet.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/photoswipe/photoswipe.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/photoswipe/photoswipe-ui-default.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/TinySlider/min/tiny-slider.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/datepicker.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/plugins/slimscroll/slimscroll.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/clamp.js', 1);
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.js', 1);
require_once ($_SERVER["DOCUMENT_ROOT"]."/local/ajax/captha.php");
?><!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<title><? $APPLICATION->ShowTitle(); ?></title>
	<?$APPLICATION->ShowMeta("keywords")?>
	<?$APPLICATION->ShowMeta("description")?>
	<?$APPLICATION->ShowMeta("robots")?>
	<?$APPLICATION->ShowCSS();?>
	<?$APPLICATION->ShowHeadStrings()?>
	<?$APPLICATION->ShowHeadScripts()?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" data-skip-moving="true">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter34265165 = new Ya.Metrika({
						id:34265165,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/34265165" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- end of Yandex.Metrika counter -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-8VPR5R54SV" data-skip-moving="true"></script>
	<script data-skip-moving="true">
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-8VPR5R54SV');
	</script>
	<!-- end of Google Analytics -->

</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<? include(__DIR__."/svg.php"); ?>
<div class="page fix-100-vh"><!-- HEADER -->
	<!-- Элемент списка (может быть со вложенным списком)-->
	<!-- Секция меню в плашке на мобильных-->
	<header class="header">
		<div class="header-view">
			<div class="container">
				<div class="header-view__wrapper"><a class="header-logo" href="/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="S-Terra logo"></a>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"top",
						array(
							"ROOT_MENU_TYPE" => "top",
							"MAX_LEVEL" => "4",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => ""
						),
						false,
						array(
							"ACTIVE_COMPONENT" => "Y"
						)
					);?>
					<div class="header__contacts">
						<div class="header-contacts">
							<div class="header-contacts__view"><a class="header-contacts__phone" href="tel:84999409061">+7 (499) 940-90-61</a>
								<button class="header-contacts__trigger" type="button">Написать нам
									<svg width="12" height="7">
										<use xlink:href="#i-chevron-bottom" href="#i-chevron-bottom"></use>
									</svg>
								</button>
							</div>
							<div class="header-contacts__pane" hidden>
								<div class="header-contacts__wrapper">
									<div class="contacts-block">
										<div class="contacts-block__question">
											<button class="btn btn-primary-inverse btn-block" type="button" data-ask-question>Задать вопрос</button>
										</div>
										<div class="contacts-block__mail">
											<div class="contacts-block__label">Напишите нам</div><a href="mailto:information@s-terra.ru">information@s-terra.ru</a>
										</div>
										<div class="contacts-block__apps">
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
						</div>
					</div>
					<div class="header__actions">
						<div class="header-search">
							<button class="btn btn-round btn-sm btn-primary-inverse header-search__trigger" type="button">
								<svg width="14" height="14">
									<use xlink:href="#i-search" href="#i-search"></use>
								</svg>
							</button>
							<?$APPLICATION->IncludeComponent(
								"bitrix:search.title",
								"header",
								array(
									"COMPONENT_TEMPLATE" => "header",
									"NUM_CATEGORIES" => "1",
									"TOP_COUNT" => "6",
									"ORDER" => "rank",
									"USE_LANGUAGE_GUESS" => "N",
									"CHECK_DATES" => "N",
									"SHOW_OTHERS" => "N",
									"PAGE" => "#SITE_DIR#search/",
									"INPUT_ID" => "title-search-input",
									"CONTAINER_ID" => "title-search",
									"CATEGORY_0_TITLE" => "",
									"CATEGORY_0" => array(
										0 => "no",
									),
								),
								false
							);?>
						</div><!--<a class="btn btn-round btn-sm btn-primary-inverse header-account" href="https://www.s-terra.ru/auth/" target="_blank">
							<svg width="16" height="16">
								<use xlink:href="#i-user" href="#i-user"></use>
							</svg></a>-->
					</div>
					<button class="icon-btn header-toggler" type="button" data-closed><span class="burger">
                                      <svg width="20" height="17">
                                        <use xlink:href="#i-burger" href="#i-burger"></use>
                                      </svg></span><span class="times">
                                      <svg width="16" height="16">
                                        <use xlink:href="#i-times" href="#i-times"></use>
                                      </svg></span></button>
				</div>
			</div>
		</div>
		<div class="header-pane" hidden>
			<div class="header-pane__mask"></div>
			<div class="header-pane__content">
				<div class="container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.title",
						"mob",
						array(
							"COMPONENT_TEMPLATE" => "mob",
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "6",
							"ORDER" => "rank",
							"USE_LANGUAGE_GUESS" => "N",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => "#SITE_DIR#search/",
							"INPUT_ID" => "title-search-input-mob",
							"CONTAINER_ID" => "title-search-mob",
							"CATEGORY_0_TITLE" => "",
							"CATEGORY_0" => array(
								0 => "no",
							),
						),
						false
					);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"top-mob",
						array(
							"ROOT_MENU_TYPE" => "top-mob",
							"MAX_LEVEL" => "4",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => ""
						),
						false,
						array(
							"ACTIVE_COMPONENT" => "Y"
						)
					);?>
					<div class="header-pane__contacts">
						<div class="contacts-block">
							<div class="contacts-block__question">
								<button class="btn btn-primary-inverse btn-block" type="button" data-ask-question>Задать вопрос</button>
							</div>
							<div class="contacts-block__mail">
								<div class="contacts-block__label">Напишите нам</div><a href="mailto:information@s-terra.ru">information@s-terra.ru</a>
							</div>
							<div class="contacts-block__apps">
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
			</div>
		</div>
	</header><!-- /HEADER --><!-- QUESTION FORM -->
	<div class="modal" id="question" tabindex="-1" role="dialog" hidden>
		<div class="modal-container" role="document">
			<div class="modal-window">
				<button class="icon-btn modal-close" type="button" data-dissmiss="modal" arial-label="Close"><span class="color-primary" aria-hidden="true">
                            <svg width="20" height="20">
                              <use xlink:href="#i-times" href="#i-times"></use>
                            </svg></span></button>
				<div class="modal-body">
					<h2 class="modal-title">Задать вопрос</h2>
					<form class="ask-question-form" id="ask-question-form" action="/local/ajax/question.php" method="GET">
						<div class="form-field">
							<label class="form-label" for="question-name">ФИО*</label>
							<input class="form-control" id="question-name" name="name">
						</div>
						<div class="form-field">
							<label class="form-label" for="question-company">Название компании*</label>
							<input class="form-control" id="question-company" name="company">
						</div>
						<div class="row">
							<div class="col col-12 col-sm-6">
								<div class="form-field">
									<label class="form-label" for="question-mail">Электронная почта*</label>
									<input class="form-control" id="question-mail" name="email" inputmode="email">
								</div>
							</div>
							<div class="col col-12 col-sm-6">
								<div class="form-field">
									<label class="form-label" for="question-phone">Номер телефона</label>
									<input class="form-control" id="question-phone" data-mask="phone" inputmode="number" name="phone" placeholder="+7 (___) ___-__-__">
								</div>
							</div>
						</div>
						<div class="form-field">
							<label class="form-label" for="question-mail">Ваш вопрос</label>
							<textarea class="form-control" id="question-text" name="question" ></textarea>
						</div>
						<div class="form-field ask-question-form__confirm">
							<label class="checkbox">
								<input id="question-agreement" type="checkbox" name="agreement"><span class="checkbox-box"></span>
								<div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf" target="_blank">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
							</label>
						</div>

                        <div class="form-field">
                            <table border="0" style="border: 0">

                                <tr>
                                    <td style="border: 0">
                                        <label class="form-label">Введите код с картинки</label>
                                        <?//='<pre>'; print_r(htmlspecialchars($cpt->GetCodeCrypt())); '</pre>';?>
                                        <input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
                                        <input id="captcha_word" name="captcha_word" class="form-control" type="text">
                                    </td>
                                    <td style="border: 0">
                                        <label class="form-label">&nbsp</label>
                                        <img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit">Отправить</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- /QUESTION FORM -->
            <div class="modal" id="partner-modal" tabindex="-1" role="dialog" hidden>
              <div class="modal-container" role="document">
                <div class="modal-window modal-window__long">
                  <button class="icon-btn modal-close" type="button" data-dissmiss="modal" arial-label="Close"><span class="color-primary" aria-hidden="true">
                            <svg width="20" height="20">
                              <use xlink:href="#i-times" href="#i-times"></use>
                            </svg></span></button>
                  <div class="modal-body">
                    <h2 class="modal-title">Стать партнером</h2>
                    <div class="modal-subtitle">Все поля обязательны для заполнения</div>
                    <form class="partner-modal-form" id="partner-modal-form" action="/local/ajax/partner-form.php" method="GET">
                      <div class="form-field">
                        <label class="form-label" for="partner-name">ФИО</label>
                        <input class="form-control" id="partner-name" name="name">
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="partner-company">Название компании</label>
                        <input class="form-control" id="partner-company" name="company">
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="partner-company">Занимаемая должность</label>
                        <input class="form-control" id="partner-position" name="position">
                      </div>
                      <div class="row">
                        <div class="col col-12 col-sm-6">
                          <div class="form-field">
                            <label class="form-label" for="partner-mail">Email</label>
                            <input class="form-control" id="partner-mail" name="email" inputmode="email">
                          </div>
                        </div>
                        <div class="col col-12 col-sm-6">
                          <div class="form-field">
                            <label class="form-label" for="partner-phone">Номер телефона</label>
                            <input class="form-control" id="partner-phone" data-mask="phone" inputmode="number" name="phone" placeholder="+7 (___) ___-__-__">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col-12 col-sm-6">
                          <div class="form-field">
                            <label class="form-label" for="partner-numberinn">ИНН</label>
                            <input class="form-control" id="partner-numberinn" name="numberinn">
                          </div>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-label">Копия лицензии ФСБ</label>
                        <div id="drop-area-uploaded">
                          <div class="uploaded-item"><span></span>
                                  <svg width="10" height="10">
                                    <use xlink:href="#i-close-icon" href="#i-close-icon"></use>
                                  </svg>
                          </div>
                        </div>
                        <div id="drop-area">
                          <input class="form-control-attachment" id="fileElem" type="file" name="attachment" placeholder="">
                          <div class="drop-area-description">Перетяните резюме сюда или выберите файл для загрузки</div>
                          <label class="btn btn-primary-inverse" for="fileElem">
                            <div class="btn-icon">
                                    <svg width="18" height="19">
                                      <use xlink:href="#i-upload-icon" href="#i-upload-icon"></use>
                                    </svg>
                            </div><span>Прикрепить файл</span>
                          </label>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="partner-text">Дополнительная информация</label>
                        <textarea class="form-control" id="partner-text" name="question"></textarea>
                      </div>
                      <div class="vacancy-form-footer">
                        <div class="form-field course-modal-form__confirm">
                          <label class="checkbox">
                            <input id="partner-agreement" type="checkbox" name="agreement"><span class="checkbox-box"></span>
                            <div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a target="_blank" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
                          </label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Отправить</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- /Course FORM -->
<div class="modal" id="course-modal" tabindex="-1" role="dialog" hidden>
              <div class="modal-container" role="document">
                <div class="modal-window">
                  <button class="icon-btn modal-close" type="button" data-dissmiss="modal" arial-label="Close"><span class="color-primary" aria-hidden="true">
                            <svg width="20" height="20">
                              <use xlink:href="#i-times" href="#i-times"></use>
                            </svg></span></button>
                  <div class="modal-body">
                    <h2 class="modal-title">Оформление заявки</h2>
                    <div class="modal-subtitle">Все поля обязательны для заполнения</div>
                    <form class="course-modal-form" id="course-modal-form" action="/local/ajax/question.php" method="GET">
                      <div class="form-field">
                        <label class="form-label" for="question-name">ФИО</label>
                        <input class="form-control" id="question-name" name="name">
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="question-company">Название компании</label>
                        <input class="form-control" id="question-company" name="company">
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="question-company">Занимаемая должность</label>
                        <input class="form-control" id="question-position" name="position">
                      </div>
                      <div class="row">
                        <div class="col col-12 col-sm-6">
                          <div class="form-field">
                            <label class="form-label" for="question-mail">Электронная почта*</label>
                            <input class="form-control" id="question-mail" name="email" inputmode="email">
                          </div>
                        </div>
                        <div class="col col-12 col-sm-6">
                          <div class="form-field">
                            <label class="form-label" for="question-phone">Номер телефона</label>
                            <input class="form-control" id="question-phone" data-mask="phone" inputmode="number" name="phone" placeholder="+7 (___) ___-__-__">
                          </div>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="question-company">Номер лицензии</label>
                        <input class="form-control" id="question-license" name="license">
                      </div>
                      <div class="form-field">
                        <label class="form-label" for="question-text">Текст обращения</label>
                        <textarea class="form-control" id="question-text" name="question"></textarea>
                      </div>
                      <div class="form-field course-modal-form__confirm">
                        <label class="checkbox">
                          <input id="question-agreement" type="checkbox" name="agreement"><span class="checkbox-box"></span>
                          <div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a target="_blank" href="/upload/medialibrary/6c7/politika_obrabotki_personal_dannyh_sterra_29-11-2019.pdf">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
                        </label>
                      </div>
                      <div class="form-field course-modal-form__confirm">
                        <label class="checkbox">
                          <input id="question-agreement-support" type="checkbox" name="support"><span class="checkbox-box"></span>
                          <div class="checkbox-label">Я ознакомлен и согласен с <a target="_blank" href="https://www.s-terra.ru/upload/medialibrary/02d/Support_Service_2022_S-Terra.pdf">условиями технической поддержки</a>.</div>
                        </label>
                      </div>
                      <button class="btn btn-primary btn-block" type="submit">Отправить</button>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- /Course FORM -->