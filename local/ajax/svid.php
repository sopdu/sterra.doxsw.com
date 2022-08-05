<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

$page = ((int)$request->get("page")>0 ? $request->get("page") : 1);

$IBLOCK_ID = 54;

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y", 'PROPERTY_file' != false ];

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
    ["sort" => "asc", "ACTIVE_FROM" => "DESC"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "ACTIVE_FROM", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_file", "PROPERTY_ACTIV_FROM", "PROPERTY_ACTIV_TO", "PROPERTY_CRIPTOGRAFY", "PROPERTY_PRODUCT", "PROPERTY_TYPE"]
);

$count = $listres->SelectedRowsCount();

while ( $arEl = $listres->GetNext() ) {
    $arClearEl["list"] = Array();
    $arClearEl["title"] = html_entity_decode($arEl["NAME"]);
    //$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
    $arClearEl["image"] = CFile::GetPath($arEl['PREVIEW_PICTURE']);
    $arClearEl["link"] = CFile::GetPath($arEl["PROPERTY_FILE_VALUE"]);
    if ($arEl['PROPERTY_TYPE_VALUE']) $arClearEl["subtitle"] = $arEl['PROPERTY_TYPE_VALUE'];
    /*$arClearEl['list'] = [];
    $products = 'На ';
    //foreach($arEl["PROPERTY_PRODUCT_VALUE"] as $idel){
    $idel = $arEl["PROPERTY_PRODUCT_VALUE"];
    $obj = CIBlockSection::GetByID($idel);
    if($objres = $obj->GetNext()) $products.= '<b>'.$objres["NAME"].',</b> ';
    //}
    $arClearEl['list'][] = $products;
    $arClearEl['list'][] = 'От '.$arEl["PROPERTY_ACTIV_FROM_VALUE"];
    $arClearEl['list'][] = 'Криптография: '.$arEl["PROPERTY_CRIPTOGRAFY_VALUE"][0];
    $arClearEl['list'][] = 'Действителен до '.$arEl["PROPERTY_ACTIV_TO_VALUE"];*/
    if($arEl['PROPERTY_PRODUCT_VALUE']){
        $prodDB = CIBlockSection::GetList(
            Array('SORT' => 'ASC'),
            Array('ID' => $arEl['PROPERTY_PRODUCT_VALUE'], 'IBLOCK_ID' => 7),
            false,
            Array('NAME')
        );
        $prod = $prodDB->Fetch();
        $arClearEl["list"][] = "<b>".$prod['NAME']."</b>";
    }
    if($arEl['ACTIVE_FROM']){
        $arClearEl["list"][].= "От ".$arEl['ACTIVE_FROM'];
    }
    $arItems[] = $arClearEl;
}

/*echo "<pre>";
print_r($arItems);
echo "</pre>";*/


$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);