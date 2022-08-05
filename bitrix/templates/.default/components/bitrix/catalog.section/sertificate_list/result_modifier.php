<?foreach ($arResult['ITEMS'] as $key => $arItem):
	if($arItem["PREVIEW_PICTURE"]){
		$arFileTmp = CFile::ResizeImageGet(
				$arItem["PREVIEW_PICTURE"],
				array("width" => 86, "height" => 122),
				BX_RESIZE_IMAGE_PROPORTIONAL           
			);
		$arResult['ITEMS'][$key]["PREVIEW_PICTURE"]["src"]=$arFileTmp["src"];
	}
endforeach;
?>