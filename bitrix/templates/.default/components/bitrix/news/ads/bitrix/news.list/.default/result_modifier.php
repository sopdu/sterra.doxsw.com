<?

foreach($arResult['ITEMS'] as $key => $arItem){

	$arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 92, "height" => 122), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'];
}

?>