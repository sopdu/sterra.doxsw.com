<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

//?page=2

$IBLOCK_ID = 46;

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y" ];

$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$arItems = [];
$listres = \CIBlockElement::GetList(
	["sort" => "asc", "CREATED_DATE" => "desc"],
	$arFilter,
	false,
	["nPageSize" => 9, "iNumPage" => $request->get("page")],
	["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["title"] = $arEl["NAME"];
	$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
	$arClearEl["type"] = 2;
	$arClearEl["icon"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"])["SRC"];
	$arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
	$arItems[] = $arClearEl;
}
$result = [
	"items" => $arItems,
	"size" => $count
];
echo json_encode($result);
