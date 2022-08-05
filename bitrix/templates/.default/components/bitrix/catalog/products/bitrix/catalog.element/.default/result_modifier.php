<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=> $arResult['PROPERTIES']['VERSION']['LINK_IBLOCK_ID'], 'ID' => $arResult['PROPERTIES']['VERSION']['VALUE'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
$i=0;
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arProp = $ob->GetProperties();
	
	$arResult['ITEMS'][$i] = $arFields; 
	$arResult['ITEMS'][$i]['PROPERTIES'] = $arProp; 
	
	
	$idCertif = $arResult['ITEMS'][$i]['PROPERTIES']['CERTIFICATION']['VALUE'];
	$idCertifIBlock = $arResult['ITEMS'][$i]['PROPERTIES']['CERTIFICATION']['IBLOCK_ID'];

	$i++;		
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array('ID' => $idCertif, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
while($ob = $res->GetNextElement()){

	$arCertifs[] = $ob->GetFields();
	
}

if(!empty($arResult['PROPERTIES']['DOCUMINTATION']['VALUE'])){
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
	$arFilter = Array('ID' => $arResult['PROPERTIES']['DOCUMINTATION']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
	while($ob = $res->GetNextElement()){

		$arResult['PROPERTIES']['DOCUMINTATION']['VALUE'] = $ob->GetFields();
		
	}
}

foreach($arResult['ITEMS'] as $key => $arItems){
	
	$arItems['PROPERTIES']['CERTIFICATION']['VALUE'];

	foreach($arCertifs as $keys => $Certif){
	
		if($arItems['PROPERTIES']['CERTIFICATION']['VALUE'][$key] == $Certif['ID']){
			
			$arResult['ITEMS'][$key]['PROPERTIES']['CERTIFICATION']['VALUE'][$keys] = $Certif;
			
		}
	}
}


$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT");
$arFilter = Array('ID' => $arItems['PROPERTIES']['MODEL']['VALUE'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
$arItems['PROPERTIES']['MODEL']['VALUE'] = array();
while($ob = $res->GetNextElement()){

	$arItems['PROPERTIES']['MODEL']['VALUE'][] = $ob->GetFields();
	
}
foreach($arResult['ITEMS'] as $key => $arItem){
	
	$arResult['ITEMS'][$key]['PROPERTIES']['MODEL']['VALUE'] = $arItems['PROPERTIES']['MODEL']['VALUE'];
}

	
?>