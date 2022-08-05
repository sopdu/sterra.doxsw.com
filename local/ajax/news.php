<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?query=null&filter_type=2&page=2
$ruMonths = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
];


$arFilter = [ "IBLOCK_ID" => 1, "=ACTIVE" => "Y" ];
if ($_GET['iblock']) $arFilter['IBLOCK_ID'] = $_GET['iblock'];


if ($_GET['filter_type'] && $_GET['filter_type'] > 1000){
    $arFilter['>=DATE_ACTIVE_FROM'] = '01.01.'.$_GET['filter_type'];
    $arFilter['<=DATE_ACTIVE_FROM'] = '12.12.'.$_GET['filter_type'];
}


if($request->get("query")!="null") {
    $arFilter["NAME"] = "%".$request->get("query")."%";
}
switch($request->get("filter_type")) {
    case 1:
        $arFilter["PROPERTY_CITY"] = 41;
        break;
    case 2:
        $arFilter["PROPERTY_CITY"] = 40;
        break;
}

$listres = \CIBlockElement::GetList(
    [],
    $arFilter,
    false,
    false,
    ["ID"]
);
$count = $listres->SelectedRowsCount();
$arItems = [];
$listres = \CIBlockElement::GetList(
    ["sort" => "desc", "CREATED_DATE" => "desc"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_TEXT", "PREVIEW_PICTURE", "ACTIVE_FROM"]
);
while ( $arEl = $listres->GetNext() ) {
    $date = strtotime($arEl['ACTIVE_FROM']);
    $arClearEl = Array(
        "img" => CFile::GetPath($arEl['PREVIEW_PICTURE']),
        "link" => $arEl['DETAIL_PAGE_URL'],
        "date" => date('d', $date).' '.$ruMonths[date('n', $date)-1].' '.date('Y', $date),
        "title" => $arEl['NAME'],
        "text" => $arEl['PREVIEW_TEXT']
    );
    $res = CIBlockElement::GetProperty($arEl["IBLOCK_ID"], $arEl["ID"], "sort", "asc", ["CODE" => "CITY"]);
    while ($ob = $res->GetNext()) {
        if ($ob["VALUE"]==40) {
            $arClearEl["type"] = 1;
        }
        if ($ob["VALUE"]==41) {
            $arClearEl["type"] = 2;
        }
        $arClearEl["subtitle"] .= ($arClearEl["subtitle"]!="" ? " / " : "").$ob["VALUE_ENUM"];
    }
    $res = CIBlockElement::GetProperty($arEl["IBLOCK_ID"], $arEl["ID"], "sort", "asc", ["CODE" => "ICON"]);
    if ($ob = $res->GetNext()) {
        $arClearEl["icon"] = $ob["VALUE"];
    }
    $arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
    $res = CIBlockElement::GetProperty($arEl["IBLOCK_ID"], $arEl["ID"], "sort", "asc", ["CODE" => "ADS_LINK"]);
    if ($ob = $res->GetNext()) {
        if ($ob["VALUE"]) $arClearEl["link"] = $ob["VALUE"];
    }
    $arItems[] = $arClearEl;
}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);
