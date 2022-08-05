<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
IncludeTemplateLangFile(__FILE__);
?> 
<!DOCTYPE html>
<html>
	<head>	
		<meta charset="utf-8"/>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle()?></title>
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
	
			
			<header class="kilo">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/include_area/logo.php",
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
				<div class="login-form right soft-grey" id='auth'></div>
				<div class="clearfix"></div>
				<br />
				<br />
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
				<?$APPLICATION->IncludeComponent("bitrix:search.title", "search", Array(
	
					),
					false
				);?>	
				<div class="clearfix"></div>
			</header>
			<div class="content kilo">
			</div>