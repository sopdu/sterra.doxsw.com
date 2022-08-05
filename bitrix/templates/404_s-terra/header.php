<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<?$APPLICATION->ShowHead();?>
<title>
<?$APPLICATION->ShowTitle()?>
</title>
<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style-clear.css");?>
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style.css");?>
<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/flexslider.css");?>
<!-- jQuery -->
<?$APPLICATION->AddHeadScript("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js");?>
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
<!-- /Yandex.Metrika counter -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '191794744514992');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=191794744514992&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>
<body>

<?$APPLICATION->ShowPanel();?>

<div id="wrapper" class="kilo">

<header>
  <table class="head-table">
    <tr class="head-tr">
      <td class="head-td"><?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/include_area/logo.php",
		"EDIT_TEMPLATE" => ""
		),
		false
);?>
      </td>

      <td class="head-td">
<!-- Блок соц.сетей начало -->
<ul style="list-style: none; padding-top: 18px;">
	<a href="https://t.me/STerraCSP" target="_blank" title="S-terra в Telegram"><li class="socialli tg-icon right"></li></a>
	<a href="https://www.instagram.com/sterracsp/" target="_blank" title="S-terra в Instagram"><li class="socialli insta-icon right"></li></a>
	<a href="http://vk.com/sterra_csp" target="_blank" title="S-terra в ВКонтакте"><li class="socialli vk-icon right"></li></a>
	<a href="http://www.youtube.com/channel/UCnu9HxldaUZZg_DzCKcK23w/" target="_blank" title="S-terra в Youtube"><li class="socialli you-icon right"></li></a>
	<a href="https://www.facebook.com/pg/STerra.CSP/posts/?ref=page_internal" target="_blank" title="S-terra в Facebook"><li class="socialli fb-icon right"></li></a>
	<a href="mailto:vopros@s-terra.ru?subject=Вопрос с сайта www.s-terra.ru" title="Задайте Ваш вопрос"><li class="voprosli vopros-button right"></li></a>
	<a href="tel:+74999409061" title="Позвоните нам"><li class="telli tel-button right">+7 (499) 940 9061</li></a>
<ul>
<!-- Блок соц.сетей конец -->
<div class="clearfix" style="padding-top: 5px;"></div>
<br>

	<a href="/auth"><div class="lk-block"><span>Личный кабинет</span></div></a>

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

<div class="clearfix"></div>

      </td>
    </tr>
  </table>
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

<div class="content kilo"><br><br><br></div>

			<div class="content kilo notfound">

					<h1>Ошибка 404</h1>
					<div class="clearfix"></div>
					<br />
					<img src="<?=SITE_TEMPLATE_PATH?>/images/content/404.jpg" alt="#"/>
					<br />
				<a href="/" class="title_button blue" style="width: 220px;">На главную страницу<span></span></a>
		
			</div>

<div class="content kilo notfound"><br><br><br><br><br><br><br></div>

