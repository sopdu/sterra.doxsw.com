<?
foreach($arResult['ITEMS'] as $key => $arItem){
	
	$arResult["ITEMS"][$key]["PROPERTIES"]["ACTION"] = CFile::GetFileArray($arItem["PROPERTIES"]["ACTION"]["VALUE"]);
	$arResult["ITEMS"][$key]["PROPERTIES"]["NO_ACTION"] = CFile::GetFileArray($arItem["PROPERTIES"]["NO_ACTION"]["VALUE"]);
}
?>