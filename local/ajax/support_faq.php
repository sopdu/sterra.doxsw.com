<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?query=null&filter_type=2&page=2


$arFilter = [ "IBLOCK_ID" => 16, "=ACTIVE" => "Y" ];
if ($_GET['iblock']) $arFilter['IBLOCK_ID'] = $_GET['iblock'];

if($request->get("query")!="null") {
    $arFilter["NAME"] = "%".$request->get("query")."%";
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
    ["nPageSize" => 3, "iNumPage" => $request->get("page") ],
    ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT"]
);
while ( $arEl = $listres->GetNext() ) {
    $arClearEl = Array(
        "title" => $arEl['NAME'],
        "description" => $arEl['PREVIEW_TEXT'],
		"descriptions" => $arEl['DETAIL_TEXT'],
		"id" => $arEl['ID'],
    );
    $arItems[] = $arClearEl;
}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);