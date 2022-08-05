<?

foreach($arResult['ITEMS'] as $key => $arItems){
	
	$arItems['PROPERTIES']['FILE']['VALUE'] = CFile::GetFileArray($arItems['PROPERTIES']['FILE']['VALUE']);
	
	$arItems['PROPERTIES']['FILE']['VALUE']['FILE_SIZE'] = ($arItems['PROPERTIES']['FILE']['VALUE']['FILE_SIZE']/1048576);
	$arItems['PROPERTIES']['FILE']['VALUE']['FILE_SIZE'] = substr($arItems['PROPERTIES']['FILE']['VALUE']['FILE_SIZE'], 0, 6)." Мб";
	
	$arResult['ITEMS'][$key]['PROPERTIES']['FILE']['VALUE'] = $arItems['PROPERTIES']['FILE']['VALUE'];
	$arResult['ITEMS'][$key]['PROPERTIES']['FILE']['VALUE']['FILE_SIZE'] = $arItems['PROPERTIES']['FILE']['VALUE']['FILE_SIZE'];
	
}
?>