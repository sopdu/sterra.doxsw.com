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


$arFilter = [ "IBLOCK_ID" => 9, "=ACTIVE" => "Y", '!PROPERTY_SAVE_FILE' => false ];


/*if ($_GET['filter_type'] && $_GET['filter_type'] > 1000){
    $arFilter['>=PROPERTY_DATE'] = $_GET['filter_type'].'-01-01 00:00:00';
    $arFilter['<=PROPERTY_DATE'] = $_GET['filter_type'].'-12-12 23:59:59';
}*/

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

if ($_GET['filter_type']) $arFilter['PROPERTY_TYPE'] = $_GET['filter_type'];

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
    ["PROPERTY_DATE" => "desc", "sort" => "asc"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_TEXT", "PREVIEW_PICTURE", "ACTIVE_FROM"]
);
while ( $arItem = $listres->GetNext() ) {
    $res = CIBlockElement::GetProperty($arFilter['IBLOCK_ID'], $arItem['ID']);
    while ($ob = $res->GetNext())
    {
        if ($ob['MULTIPLE'] == "Y"){
            if ($arItem['PROPERTIES'][$ob['CODE']]){
                $arItem['PROPERTIES'][$ob['CODE']]['VALUE'][] = $ob['VALUE'];
            } else{
                $arItem['PROPERTIES'][$ob['CODE']] = $ob;
                $arItem['PROPERTIES'][$ob['CODE']]['VALUE'] = [];
                $arItem['PROPERTIES'][$ob['CODE']]['VALUE'][] = $ob['VALUE'];
            }
        } else{
            $arItem['PROPERTIES'][$ob['CODE']] = $ob;
        }
    }

    $dateText = '';
    $date = strtotime($arItem['PROPERTIES']['DATE']['VALUE']);
    if ($date) $dateText = date('d', $date).' '.$ruMonths[date('n', $date)-1].' '.date('Y', $date);


    $arClearEl = Array(
        "link" => CFile::GetPath($arItem['PROPERTIES']['SAVE_FILE']['VALUE']),
        "date" => $dateText,
        "title" => $arItem['NAME'],
        "name" => $arItem['PROPERTIES']['AUTOR']['VALUE'],
        "locale" => $arItem['PROPERTIES']['SOURSE']['VALUE']
    );
    $arItems[] = $arClearEl;
}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);
