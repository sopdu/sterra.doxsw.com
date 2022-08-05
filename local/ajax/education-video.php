<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

$page = ((int)$request->get("page")>0 ? $request->get("page") : 1);

$IBLOCK_ID = 56;

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y" ];

if($request->get("query")!="null" && $request->get("query")!="") {
	$arFilter["NAME"] = "%".$request->get("query")."%";
}


$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$arItems = [];

if ($_GET['prodID']) $arFilter['PROPERTY_versia'] = $_GET['prodID'];
$listres = \CIBlockElement::GetList(
    ["sort" => "asc"],
    $arFilter,
    false,
    ["nPageSize" => 20, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
);

/*if (!$_GET['prodID']) {
    $listres = \CIBlockElement::GetList(
        ["sort" => "asc"],
        $arFilter,
        false,
        ["nPageSize" => 20, "iNumPage" => $request->get("page")],
        ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
    );
} else{
    $prodDB = CIBlockSection::GetList(
        Array('SORT' => 'ASC'),
        Array('ID' => $_GET['prodID'], 'IBLOCK_ID' => 7),
        false,
        Array('UF_VIDEO')
    );
    $prod = $prodDB->Fetch();
    $listres = \CIBlockElement::GetList(
        ["sort" => "asc"],
        Array('ID' => $prod['UF_VIDEO'], 'IBLOCK_ID' => $IBLOCK_ID),
        false,
        ["nPageSize" => 20, "iNumPage" => $request->get("page")],
        ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
    );
    $count = count($prod['UF_VIDEO']);
}*/
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["title"] = html_entity_decode($arEl["NAME"]);
	//$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
	$arClearEl["image"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"])["SRC"];
	$arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
	$arItems[] = $arClearEl;
}
$result = [
	"items" => $arItems,
	"size" => $count
];
echo json_encode($result);
