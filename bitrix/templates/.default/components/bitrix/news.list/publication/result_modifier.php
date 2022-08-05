<?
foreach($arResult['ITEMS'] as $key => $arItem){

	$arItem['PROPERTIES']['SAVE_FILE']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['SAVE_FILE']['VALUE']);
	
	$arResult['ITEMS'][$key]['PROPERTIES']['SAVE_FILE']['VALUE'] = $arItem['PROPERTIES']['SAVE_FILE']['VALUE'];	
}

?>