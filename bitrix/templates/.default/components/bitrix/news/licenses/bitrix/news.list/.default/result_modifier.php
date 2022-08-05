<?

foreach($arResult['ITEMS'] as $key => $arItem){

	$arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 92, "height" => 122), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	
	$arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']);

	
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'];
	$arResult['ITEMS'][$key]['PROPERTIES']['FILE_FOR_SAVE']['VALUE'] = $arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE'];
	$arResult['ITEMS'][$key]['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'] = $arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'];


}

?>