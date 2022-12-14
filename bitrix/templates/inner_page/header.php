<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
CJSCore::Init(array("ajax", "json", "Is", "session", "jquery", "popup", "pull"));
?> 
<!DOCTYPE html>
<html>
	<head>	
		<meta charset="utf-8"/>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?$APPLICATION->ShowHead();?>
		<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style-clear.css");?>
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/style.css");?>
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/flexslider.css");?>
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/jquery.formstyler.css");?>
		<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/style-note.css");?>

		<!-- jQuery -->
		<?$APPLICATION->AddHeadScript("https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js");?>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

		<!-- FlexSlider -->
		<?$APPLICATION->AddHeadScript("/local/template_files/js/jquery.flexslider.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/tabs_click-to-activate.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/script.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/jquery.maskedinput.js");?>
		<script type="text/javascript"></script>
		
		<!-- fancybox -->
		<?$APPLICATION->AddHeadScript("/local/template_files/css/source/jquery.fancybox.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/css/source/jquery.fancybox.pack.js");?>
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/source/jquery.fancybox.css");?>


<script type="text/javascript">
$(document).ready(function() {
$('.zoom').fancybox({
openEffect : 'fade',
prevEffect : 'fade',
nextEffect : 'fade',
closeEffect : 'fade'
});
});
</script>

		
		<!--jquery UI-->
		<?$APPLICATION->SetAdditionalCSS("/local/template_files/css/jquery-ui.css");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/jquery-ui.js");?>

		<!-- Modernizr -->
		<?$APPLICATION->AddHeadScript("/local/template_files/js/modernizr.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/jquery.formstyler.js");?>
		<?$APPLICATION->AddHeadScript("/local/template_files/js/custom.js");?>

<!-- Login form for Joomla -->
<script>
                $(document).ready(
                function () {


$.ajax({
  url: "https://old.s-terra.com/auth",
headers: {
	'Access-Control-Allow-Origin':'https://old.s-terra.com/auth',
	'Access-Control-Request-Methods': 'GET, POST, OPTIONS'
    },
					method: "POST"
}).done(function(msg) {
	//  alert( "done" );
  $('#auth').html( msg );
  $('#auth').trigger('create');
});
				});
               </script>
	        <!--<script>
                $(document).ready(
                function () {
                               $('#auth').load('/joomla/auth/', function() {
                                               $('#auth').trigger('create');
                            });
                            }
               );
               </script>-->

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
<!--end of Yandex.Metrika counter -->
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
				<a href="https://www.facebook.com/pg/STerra.CSP/posts/?ref=page_internal" class="fb" title="S-Terra ?? Facebook" target="_blank"></a>
				<a href="https://www.youtube.com/c/STerraCSP/" class="youtube" title="S-Terra ?? Youtube" target="_blank"></a>
				<a href="https://vk.com/sterra_csp" class="vk" title="S-Terra ?? ??????????????????" target="_blank"></a>
				<a href="https://www.instagram.com/sterracsp/" class="insta" title="S-Terra ?? Instagram" target="_blank"></a>
				<a href="https://t.me/STerraCSP" class="tg" title="S-Terra ?? Telegram" target="_blank"></a>
			</div>
		
			<div class="topStripeContainerSmall">
		
				<a href="tel:+74999409061" class="phone" title="?????????????????? ??????">+7 (499) 940 9061</a>

				<a href="/auth/" target="_blank">
					<div class="account" title="???????? ?? ???????????? ??????????????">
						<svg version="1.1" id="????????_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="15px" height="15px" viewBox="0 0 15 15" enable-background="new 0 0 15 15" xml:space="preserve" class="icon-account">
							<g>
								<path fill="#C4C4C4" d="M11.25,3.75c0,2.075-1.676,3.75-3.75,3.75c-2.075,0-3.75-1.675-3.75-3.75C3.75,1.675,5.425,0,7.5,0
									C9.574,0,11.25,1.675,11.25,3.75z M0,13.75c0-2.5,5-3.875,7.5-3.875S15,11.25,15,13.75V15H0V13.75z"/>
							</g>
						</svg>
						???????????? ??????????????
					</div>
				</a>
				
				<a href="mailto:vopros@s-terra.ru?subject=???????????? ?? ?????????? www.s-terra.ru [ <?php echo date("d.m.y H:i"); ?> ]" alt="?????????????? ?????? ????????????" target="_blank">
					<div class="mail-vopros" title="???????????????? ??????">
						<img src="/local/template_files/images/icon-mail.svg" class="icon-mail" >
						?????????????? ?????? ????????????!
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
<div class="slogan">?????? ???????????????? ?? ???????? ????????????????????????</div>

	<!-- ???????? ???????????? ???????????? -->
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
	<!-- ???????? ???????????? ?????????? -->

</div>

  <div class="clearfix"></div>

  <!-- ???????? ???????? ???????????? -->
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
  <!-- ???????? ???????? ???????????? -->
  
  <div class="clearfix"></div>

</header>


			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"breabcrumbs",
				Array(
				)
			);?>
			<?if($APPLICATION->GetCurDir() == '/contacts/' || $APPLICATION->GetCurDir() == '/search/' ):?>
			<?else:?>
				<div class="content kilo">
					<div class="four left">			
						<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_left_menu", 
	array(
		"ROOT_MENU_TYPE" => "",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "leftchild",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "main_left_menu",
		"MENU_THEME" => "site"
	),
	false
);?>

	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "sect",
		"PATH" => "inc",
		"EDIT_TEMPLATE" => "standard.php",
		"COMPONENT_TEMPLATE" => ".default",
		"AREA_FILE_SUFFIX" => "inc",
		"AREA_FILE_RECURSIVE" => "Y"
	),
	false,
	array("HIDE_ICONS"=>"N" )
);?>

					</div>
					<?if(stripos($APPLICATION->GetCurDir(),'/company/')!==false||stripos($APPLICATION->GetCurDir(),'/partnery/')!==false):?>
						</div>
					<?endif;?>
				
			<?endif?>	
