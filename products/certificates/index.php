<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сертификаты");
?><div class="twelve right">
	<h1><?=$APPLICATION->GetTitle()?></h1>
<?/*
	<div class="otstup">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?>
</div>
	*/?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"sertificat", 
	array(
		"COMPONENT_TEMPLATE" => "sertificat",
		"IBLOCK_TYPE" => "products",
		"IBLOCK_ID" => "41",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"VIEW_MODE" => "LINE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y"
	),
	false
);?>
	</div>	
 
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>