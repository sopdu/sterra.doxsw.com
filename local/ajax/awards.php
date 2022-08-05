<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?query=null&filter_type=2&page=2

switch($request->get("filter_type")) {
	case 1:
		$IBLOCK_ID = 26;
		break;
	case 2:
		$IBLOCK_ID = 27;
		break;
}

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y" ];

$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$arItems = [];
$listres = \CIBlockElement::GetList(
	["SORT" => "DESC", "CREATED_DATE" => "DESC"],
	$arFilter,
	false,
	["nPageSize" => 8, "iNumPage" => $request->get("page")],
	["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["title"] = $arEl["NAME"];
	$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
	switch($arEl["IBLOCK_ID"]) {
		case 26:
			$arClearEl["type"] = 1;
			break;
		case 27:
			$arClearEl["type"] = 2;
			break;
	}
	$arClearEl["image"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"])["SRC"];
	$arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
	$arItems[] = $arClearEl;
}
$result = [
	"items" => $arItems,
	"size" => $count
];
echo json_encode($result);
