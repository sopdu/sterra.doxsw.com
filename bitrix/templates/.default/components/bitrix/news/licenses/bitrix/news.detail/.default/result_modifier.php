<?
	$arResult['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array("width" => 800, "height" => 169), BX_RESIZE_IMAGE_PROPORTIONAL, true);

	$arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']);


	$arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE'] = $arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE'];
	$arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'] = $arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'];	
?>