<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Публикации в прессе");
?><div class="twelve right article">
	<h1><?=$APPLICATION->GetTitle()?> </h1>
<div class="otstup"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
Array()
);?></div>
</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search_field", 
	array(
		"COMPONENT_TEMPLATE" => "search_field",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/company/publication.php",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "Поиск по публикациям",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "iblock_about",
		),
		"CATEGORY_0_iblock_products" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_support" => array(
			0 => "19",
		),
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CATEGORY_0_iblock_about" => array(
			0 => "9",
		),
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => array(
			0 => "iblock_about",
		),
		"CATEGORY_1_iblock_about" => array(
			0 => "9",
		)
	),
	false
);?> 
<?
/*
if($_REQUEST['q']){
	$arrFilter["NAME"]='%'.$_REQUEST["q"].'%';
}
*/
if($_REQUEST['q']) {
	$arrFilter[] = array(
		"LOGIC" => "OR",
		array("NAME"=>'%'.$_REQUEST["q"].'%'),
		array("PROPERTY_AUTOR"=>'%'.$_REQUEST["q"].'%'),
		array("PROPERTY_SOURSE"=>'%'.$_REQUEST["q"].'%')
	);
}

?>


<!--start-->
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"publication_years", 
	array(
		"IBLOCK_TYPE" => "about",
		"IBLOCK_ID" => "9",
		"NEWS_COUNT" => "60",
		"SORT_BY1" => "",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "AUTOR",
			1 => "DATE",
			2 => "DATE_STRING",
			3 => "SOURSE",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "News",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "publication",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "publication_years",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>