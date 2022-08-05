<?


foreach($arResult['ITEMS'] as $key => $arItem){

	$arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 92, "height" => 122), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	
	$arItem['PROPERTIES']['SAVE_FILE']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['SAVE_FILE']['VALUE']);
	$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'] = ($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE']/1048576);
	$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'] = substr($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'], 0, 6)." Мб";
	
	$arItem['FIELDS']['DATE_ACTIVE_FROM'] = EditData($arItem['FIELDS']['DATE_ACTIVE_FROM']);
	$arItem['FIELDS']['DATE_ACTIVE_TO'] = EditData($arItem['FIELDS']['DATE_ACTIVE_TO']);
	
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'];
	$arResult['ITEMS'][$key]['PROPERTIES']['SAVE_FILE']['VALUE'] = $arItem['PROPERTIES']['SAVE_FILE']['VALUE'];
	$arResult['ITEMS'][$key]['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'] = $arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'];
	$arResult['ITEMS'][$key]['FIELDS']['DATE_ACTIVE_FROM'] = $arItem['FIELDS']['DATE_ACTIVE_FROM'];
	$arResult['ITEMS'][$key]['FIELDS']['DATE_ACTIVE_TO'] = $arItem['FIELDS']['DATE_ACTIVE_TO'];

}

?>