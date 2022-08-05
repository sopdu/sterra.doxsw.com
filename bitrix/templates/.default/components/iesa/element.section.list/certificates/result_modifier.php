<?
foreach($arResult["SECTION"] as $key=> $arSect){
	
	foreach($arSect['ELEMENTS'] as $key_el => $arItem){
		$arResult['SECTION'][$key]['ELEMENTS'][$key_el]['PREVIEW_PICTURE_BIG'] = $arItem['PREVIEW_PICTURE'];
		$arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 92, "height" => 122), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult['SECTION'][$key]['ELEMENTS'][$key_el]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'];
		
		if(!empty($arItem['PROPERTIES']['ACTIV_FROM']['VALUE'])){
			$arItem['PROPERTIES']['ACTIV_FROM']['VALUE'] = EditData($arItem['PROPERTIES']['ACTIV_FROM']['VALUE']);
			$arItem['PROPERTIES']['ACTIV_FROM']['VALUE'] = $arItem['PROPERTIES']['ACTIV_FROM']['VALUE']['DAY']." ".$arItem['PROPERTIES']['ACTIV_FROM']['VALUE']['MONTH']." ".$arItem['PROPERTIES']['ACTIV_FROM']['VALUE']['YEARS'];
		}
		
		if(!empty($arItem['PROPERTIES']['ACTIV_TO']['VALUE'])){
			$arItem['PROPERTIES']['ACTIV_TO']['VALUE'] = EditData($arItem['PROPERTIES']['ACTIV_TO']['VALUE']);
			$arItem['PROPERTIES']['ACTIV_TO']['VALUE'] = $arItem['PROPERTIES']['ACTIV_TO']['VALUE']['DAY']." ".$arItem['PROPERTIES']['ACTIV_TO']['VALUE']['MONTH']." ".$arItem['PROPERTIES']['ACTIV_TO']['VALUE']['YEARS'];
		}
		
		$res = CIBlockSection::GetByID($arItem['PROPERTIES']['PRODUCT']['VALUE']);	
		if($ar_res = $res->GetNext()){
			$arResult['SECTION'][$key]['ELEMENTS'][$key_el]['PROPERTIES']["PRODUCT"]["NAME"] = $ar_res["NAME"];
		}
		
		$arResult['SECTION'][$key]['ELEMENTS'][$key_el]['PROPERTIES']['ACTIV_FROM']['VALUE'] = $arItem['PROPERTIES']['ACTIV_FROM']['VALUE'];
		$arResult['SECTION'][$key]['ELEMENTS'][$key_el]['PROPERTIES']['ACTIV_TO']['VALUE'] = $arItem['PROPERTIES']['ACTIV_TO']['VALUE'];
	}
}
?>