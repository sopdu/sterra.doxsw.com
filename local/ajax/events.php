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


$arFilter = [ "IBLOCK_ID" => 11, "=ACTIVE" => "Y" ];

if($request->get("query")!="null") {
    $arFilter["NAME"] = "%".$request->get("query")."%";
}

if ($_GET['filter_type'] && $_GET['filter_type'] > 1000){
    $arFilter['>=PROPERTY_FROM'] = $_GET['filter_type'].'-01-01';
    $arFilter['<=PROPERTY_TO'] = $_GET['filter_type'].'-12-12';
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

    $dateFrom = strtotime($arItem['PROPERTIES']['FROM']['VALUE']);
    $dateTo = strtotime($arItem['PROPERTIES']['TO']['VALUE']);
    $dateText = '';
    if ($dateFrom){
        $dateText = date('d', $dateFrom).' '.$ruMonths[date('n', $dateFrom)-1];
        if (date('Y', $dateFrom) != date('Y', $dateTo)) $dateText.=' '.date('Y', $dateFrom);
        if ($dateTo) $dateText .= ' - '. date('d', $dateTo).' '.$ruMonths[date('n', $dateTo)-1].' '.date('Y', $dateTo);
    }

    if (!$arItem['PROPERTIES']['PLACE']['VALUE'] || $arItem['PROPERTIES']['PLACE']['VALUE'] == 'Он-лайн' || $arItem['PROPERTIES']['PLACE']['VALUE'] == 'Онлайн'){
        $icon = 'pc';
        $place = 'Онлайн';
    } else{
        $icon = 'map';
        $place = $arItem['PROPERTIES']['PLACE']['VALUE'];
    }



    $arClearEl = Array(
        "img" => CFile::GetPath($arItem['PREVIEW_PICTURE']),
        "link" => $arItem['DETAIL_PAGE_URL'],
        "date" => $dateText,
        "title" => $arItem['NAME'],
        "text" => $arItem['PREVIEW_TEXT'],
        "locale" => $place,
        "icon" => $icon
    );
    $arItems[] = $arClearEl;
}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);
