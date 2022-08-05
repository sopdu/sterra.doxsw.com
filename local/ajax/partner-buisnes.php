<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?page=2



$IBLOCK_ID = 15;

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y" ];

if($request->get("query")!="null") {
    $arFilter["NAME"] = "%".$request->get("query")."%";
}

if($_GET['region']) $arFilter["PROPERTY_REGION_VALUE"] = $_GET['region'];
if($_GET['city'] && $_GET['city'] != 'Все города') $arFilter["PROPERTY_CITY"] = $_GET['city'];



//$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$count = CIBlockElement::GetList(
    ["sort" => "asc", "NAME" => "asc"],
    $arFilter,
    Array(),
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "PROPERTY_CITY", "PROPERTY_REGION", "PROPERTY_SITE_LINK"]
);

$arItems = [];
$listres = \CIBlockElement::GetList(
    ["sort" => "asc", "NAME" => "asc"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "PROPERTY_CITY", "PROPERTY_REGION", "PROPERTY_SITE_LINK"]
);

while ( $arEl = $listres->GetNext() ) {
    $arClearEl["title"] = $arEl["NAME"];
    $arClearEl['city'] = $arEl["PROPERTY_CITY_VALUE"];
    $arClearEl['area'] = $arEl["PROPERTY_REGION_VALUE"];
    $arClearEl['disabled'] = 0;
    $arClearEl['link'] = '';
    if ($arEl["PROPERTY_SITE_LINK_VALUE"]) $arClearEl['link'] = $arEl["PROPERTY_SITE_LINK_VALUE"];
    else $arClearEl['disabled'] = 1;
    $arItems[] = $arClearEl;
}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);
