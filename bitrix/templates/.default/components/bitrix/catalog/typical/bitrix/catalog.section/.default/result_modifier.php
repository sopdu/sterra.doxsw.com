<?
if($arResult['DETAIL_PICTURE'])
	$arResult['PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array("width" => 800, "height" => 169), BX_RESIZE_IMAGE_PROPORTIONAL, true);
else 
	$arResult['PICTURE'] = CFile::ResizeImageGet($arResult['PICTURE'], array("width" => 800, "height" => 169), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>