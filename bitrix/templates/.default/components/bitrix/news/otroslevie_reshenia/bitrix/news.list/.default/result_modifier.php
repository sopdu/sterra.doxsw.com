<?
foreach($arResult['ITEMS'] as $key => $arItems){

	$arItems['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItems['PREVIEW_PICTURE'], Array("width" => 90, "height" => 90));
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItems['PREVIEW_PICTURE'];
	$arResult["ITEMS"][$key]["PROPERTIES"]["ACTION"] = CFile::GetFileArray($arItem["PROPERTIES"]["ACTION"]["VALUE"]);
	$arResult["ITEMS"][$key]["PROPERTIES"]["NO_ACTION"] = CFile::GetFileArray($arItem["PROPERTIES"]["NO_ACTION"]["VALUE"]);
}
?>