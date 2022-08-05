<?php
$_GET['PAGEN_1'] = $_GET['page'];
$_REQUEST['PAGEN_1'] = $_GET['page'];
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$_GET['q'] = $_GET['query'];
$_REQUEST['q'] = $_GET['query'];

$APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "json",
    Array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "DEFAULT_SORT" => "rank",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FILTER_NAME" => "",
        "NO_WORD_LOGIC" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "search_nav_new",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGE_RESULT_COUNT" => 10,
        "PATH_TO_USER_PROFILE" => "",
        "RATING_TYPE" => "",
        "RESTART" => "N",
        "SHOW_ITEM_DATE_CHANGE" => "N",
        "SHOW_ITEM_TAGS" => "N",
        "SHOW_ORDER_BY" => "N",
        "SHOW_RATING" => "",
        "SHOW_TAGS_CLOUD" => "N",
        "SHOW_WHEN" => "N",
        "SHOW_WHERE" => "N",
        "USE_LANGUAGE_GUESS" => "N",
        "USE_SUGGEST" => "N",
        "USE_TITLE_RANK" => "N",
        "arrFILTER" => array("no")
    )
);
?>

