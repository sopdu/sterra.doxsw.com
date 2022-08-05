<?
foreach($arResult['ITEMS'] as $key => $arItems){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=> $arItems['PROPERTIES']['MODEL']['LINK_IBLOCK_ID'], 'ID' => $arItems['PROPERTIES']['MODEL']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
	while($ob = $res->GetNext())
	{	
		$arModel[] = $ob;
		
	}
	
	$arResult['ITEMS'][$key]['PROPERTIES']['MODEL']['ELEMENTS'] = $arModel;	
}

foreach($arResult['ITEMS'] as $key => $arItems){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=> $arItems['PROPERTIES']['CERTIFICATION']['LINK_IBLOCK_ID'], 'ID' => $arItems['PROPERTIES']['CERTIFICATION']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
	while($ob = $res->GetNext())
	{	
		$arCert[] = $ob;
		
	}
	
	$res = CIBlockElement::GetByID($arItems['PROPERTIES']['DOCUMINTATION']['VALUE']);
	if($ar_res = $res->GetNext())
		$arItems['PROPERTIES']['DOCUMINTATION']['VALUE'] = $ar_res;
	
	$arResult['ITEMS'][$key]['PROPERTIES']['DOCUMINTATION'] = $arItems['PROPERTIES']['DOCUMINTATION']['VALUE'];
	
	$arResult['ITEMS'][$key]['PROPERTIES']['CERTIFICATION']['ELEMENTS'] = $arCert;	
}
?>