<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?><div class="kilo right article">
	<h1>Карта сайта</h1>
 <br>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	"sitemap", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "1",
		"COMPONENT_TEMPLATE" => "sitemap",
		"LEVEL" => "4",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "Y"
	),
	false
);?>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>