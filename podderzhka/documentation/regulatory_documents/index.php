<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Нормативные документы");

?><div class="twelve right">
	<h1><?=$APPLICATION->GetTitle()?></h1>
	<div class="otstup"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?></div> <?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"search_field",
	Array(
		"COMPONENT_TEMPLATE" => "search_field",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/podderzhka/documentation/regulatory_documents/",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "Поиск по документам",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(0=>"iblock_support",),
		"CATEGORY_0_iblock_products" => array(0=>"all",),
		"CATEGORY_0_iblock_support" => array(0=>"19",),
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75"
	)
);?><br>
	 <?$APPLICATION->IncludeComponent(
	"iesa:faq.list",
	"normativ_documents",
	Array(
		"IBLOCK_TYPE" => "support",
		"IBLOCK_ID" => "20",
		"PROPERTY_CODE" => array(0=>"NUMBER",1=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => "normativ_documents"
	)
);?><br>
</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>