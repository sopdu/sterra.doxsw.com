<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Документация");
?><div class="twelve right">
	<h1><?=$APPLICATION->GetTitle()?></h1>
	<div class="otstup">
		<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?>
	</div>
</div>
 <?$APPLICATION->IncludeComponent(
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
		"PAGE" => "/podderzhka/documentation/",
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
);?> <?$APPLICATION->IncludeComponent(
	"iesa:element.section.list.corrected", 
	"documents", 
	array(
		"IBLOCK_TYPE" => "support",
		"IBLOCK_ID" => "19",
		"SECTION_ID" => array(
			0 => "26",
			1 => "40",
			2 => "41",
			3 => "60",
			4 => "",
		),
		"COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "CREATED_DATE",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FILE",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Секции и элементы",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "documents"
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>