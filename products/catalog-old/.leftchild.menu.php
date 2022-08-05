<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "iesa:menu.sections",
    "",
    Array(
        "ID" => $_REQUEST["ELEMENT_ID"], 
        "IBLOCK_TYPE" => "products", 
        "IBLOCK_ID" => "7",
        "DEPTH_LEVEL" => "3",
        "SECTION_URL" => "/products/catalog/#SECTION_CODE#/", 
        "CACHE_TIME" => "3600"
    )
);
$aMenuLinks = $aMenuLinksExt;
?>