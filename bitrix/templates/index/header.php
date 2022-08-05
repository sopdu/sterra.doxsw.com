<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array("fx"));
CJSCore::Init(array("ajax"));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="yandex-verification" content="145cfd31c94ea756" />
<?$APPLICATION->ShowHead();?>
<title>
<?$APPLICATION->ShowTitle()?>
</title>
<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style-clear.css");?>
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style.css");?>
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/flexslider.css");?>
<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/style-note.css");?>
<!-- jQuery -->
<?$APPLICATION->AddHeadScript("https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js");?>
<script>window.jQuery || document.write('<script src="/local/template_files/js/libs/jquery-1.7.min.js">\x3C/script>')</script>
<!-- FlexSlider -->
<?$APPLICATION->AddHeadScript("/local/template_files/js/jquery.flexslider.js");?>
<!-- Modernizr -->
<?$APPLICATION->AddHeadScript("/local/template_files/js/modernizr.js");?>
<?$APPLICATION->AddHeadScript("/local/template_files/js/custom.js");?>

<!-- Login form for Joomla -->
<script>
    $(document).ready(
       function () {
           $('#auth').load('/joomla/auth/', function() {
                $('#auth').trigger('create');
                             });
                }
          );
</script>
<!-- Login form for Joomla -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8VPR5R54SV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8VPR5R54SV');
</script>
<!-- end of Google Analytics -->
</head>
<body>

<?$APPLICATION->ShowPanel();?>

    <div class="topStripe">
	
        <div class="topStripeContainerLarge">
		
			<div class="social-container">
				<a href="https://www.facebook.com/pg/STerra.CSP/posts/?ref=page_internal" class="fb" title="S-Terra в Facebook" target="_blank"></a>
				<a href="https://www.youtube.com/c/STerraCSP/" class="youtube" title="S-Terra в Youtube" target="_blank"></a>
				<a href="https://vk.com/sterra_csp" class="vk" title="S-Terra в ВКонтакте" target="_blank"></a>
				<a href="https://www.instagram.com/sterracsp/" class="insta" title="S-Terra в Instagram" target="_blank"></a>
				<a href="https://t.me/STerraCSP" class="tg" title="S-Terra в Telegram" target="_blank"></a>
			</div>
		
			<div class="topStripeContainerSmall">
		
				<a href="tel:+74999409061" class="phone" title="Позвоните нам">+7 (499) 940 9061</a>

				<a href="/auth/" target="_blank">
					<div class="account" title="Вход в личный кабинет">
						<svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="15px" height="15px" viewBox="0 0 15 15" enable-background="new 0 0 15 15" xml:space="preserve" class="icon-account">
							<g>
								<path fill="#C4C4C4" d="M11.25,3.75c0,2.075-1.676,3.75-3.75,3.75c-2.075,0-3.75-1.675-3.75-3.75C3.75,1.675,5.425,0,7.5,0
									C9.574,0,11.25,1.675,11.25,3.75z M0,13.75c0-2.5,5-3.875,7.5-3.875S15,11.25,15,13.75V15H0V13.75z"/>
							</g>
						</svg>
						Личный кабинет
					</div>
				</a>
				
				<a href="mailto:vopros@s-terra.ru?subject=Вопрос с сайта www.s-terra.ru [ <?php echo date("d.m.y H:i"); ?> ]" alt="Задайте Ваш вопрос" target="_blank">
					<div class="mail-vopros" title="Напишите нам">
						<img src="/local/template_files/images/icon-mail.svg" class="icon-mail" >
						Задайте Ваш вопрос!
					</div>
				</a>
			</div>
        </div>
    </div>



<div id="wrapper" class="kilo">

<header>


<div class="logoContainer">
	<a href="#">
		<div class="logo">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/include_area/logo.php",
						"EDIT_TEMPLATE" => ""
						),
						false
				);?>
		</div>
    </a>

<!--<div class="slogan">Ваш ориентир в мире безопасности</div>-->

	<!-- Блок поиска начало -->
	<div class="right">
	<?$APPLICATION->IncludeComponent(
		"bitrix:search.title", 
		"search_new", 
		array(
			"COMPONENT_TEMPLATE" => "search_new",
			"NUM_CATEGORIES" => "1",
			"TOP_COUNT" => "5",
			"ORDER" => "date",
			"USE_LANGUAGE_GUESS" => "Y",
			"CHECK_DATES" => "N",
			"SHOW_OTHERS" => "N",
			"PAGE" => "#SITE_DIR#search/index.php",
			"CATEGORY_0_TITLE" => "",
			"CATEGORY_0" => array(
			)
		),
		false
	);?>
	</div>
	<!-- Блок поиска конец -->

</div>

<div class="clearfix"></div>



  <!-- Блок меню начало -->
  <?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"main_menu",
					Array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => "",
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					)
				);?>
  <!-- Блок меню начало -->
  
  <div class="clearfix"></div>

</header>

<div class="content kilo"> </div>
