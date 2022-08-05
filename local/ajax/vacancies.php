<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?query=null&filter_type=2&page=2

$arFilter = [ "IBLOCK_ID" => 4, "=ACTIVE" => "Y" ];

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
	["nPageSize" => 6, "iNumPage" => $request->get("page")],
	["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["title"] = $arEl["NAME"];
	$arClearEl["subtitle"] = "";
	$arClearEl["type"] = "";
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
	    $icon = '';
	    if ($ob['VALUE']) $icon = CFile::GetPath($ob["VALUE"]);
		$arClearEl["icon"] = $icon;
	}
	$arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
	$arItems[] = $arClearEl;
}
$result = [
	"items" => $arItems,
	"size" => $count
];
echo json_encode($result);
