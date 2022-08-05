<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

$page = ((int)$request->get("page")>0 ? $request->get("page") : 1);

$IBLOCK_ID = 41;

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y", 'PROPERTY_file' != false ];

if($request->get("query")!="null" && $request->get("query")!="") {
    $arFilter["NAME"] = "%".$request->get("query")."%";
}
if($request->get("product")!="null" && $request->get("product")!="") {
    $arFilter["PROPERTY_PRODUCT"] = $request->get("product");
}
if($request->get("type")!="null" && $request->get("type")!="") {
    $arFilter["PROPERTY_TYPE"] = $request->get("type");
}



$arItems = [];

$listres = \CIBlockElement::GetList(
    ["SORT" => "ASC", "ID" => "ASC"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_file", "PROPERTY_ACTIV_FROM", "PROPERTY_ACTIV_TO"]
);


$count = $listres->SelectedRowsCount();

while ( $arEl = $listres->Fetch() ) {
  /*  echo "<pre>";
    print_r($arEl);
    echo "</pre>";*/
    $arClearEl["title"] = html_entity_decode($arEl["NAME"]);
    //$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
    $arClearEl["image"] = CFile::GetPath($arEl['PREVIEW_PICTURE']);
    $arClearEl["link"] = $arEl["PROPERTY_FILE_VALUE"] ? CFile::GetPath($arEl["PROPERTY_FILE_VALUE"]) : '';
    $arClearEl['list'] = [];

    $productsDB = CIBlockElement::GetProperty($IBLOCK_ID, $arEl['ID'], array(), array("CODE" => "PRODUCT"));
    $first = true;
    while ($propProduct = $productsDB->Fetch()) {
        $idel = $propProduct['VALUE'];
        /*$idel = $arEl["PROPERTY_PRODUCT_VALUE"];*/
        $obj = CIBlockSection::GetByID($idel);
        if ($objres = $obj->GetNext()) {
            if (!$first) $objres["NAME"] = ', '.$objres["NAME"];
            else {
                $products = 'На ';
                $first = false;
            }
            $products .= '<b>' . $objres["NAME"] . '</b> ';
        }
    }

    $cryptoDB = CIBlockElement::GetProperty($IBLOCK_ID, $arEl['ID'], array(), array("CODE" => "CRIPTOGRAFY"));
    $first = true;
    $cryptoText = '';
    while ($crypto = $cryptoDB->Fetch()){
        if (!$first) $cryptoText.= ', ';
        else $first = false;
        $cryptoText.= $crypto['VALUE_ENUM'];
    }


    $arClearEl['list'][] = $products;
    $arClearEl['list'][] = 'От '.$arEl["PROPERTY_ACTIV_FROM_VALUE"];
    $arClearEl['list'][] = 'Криптография: '.$cryptoText;
    $arClearEl['list'][] = 'Действителен до '.$arEl["PROPERTY_ACTIV_TO_VALUE"];

    $arItems[] = $arClearEl;

}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);