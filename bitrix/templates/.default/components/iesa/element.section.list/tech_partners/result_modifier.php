<?

foreach($arResult['SECTION'] as $key => $arItems){

	foreach($arItems['ELEMENTS'] as $key_elem => $arElem){
		
		
		$arElem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arElem['PREVIEW_PICTURE'], Array("width" => 90, "height" => 90));
		$arResult['SECTION'][$key]['ELEMENTS'][$key_elem]['PREVIEW_PICTURE'] = $arElem['PREVIEW_PICTURE'];
	}	
		
}


$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult['ID']));
while($enum_fields = $property_enums->GetNext())
{
  $arResult['SELECT'][] = $enum_fields;
}

$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

if(intval($_REQUEST['region']) > 0)
 $arFilter['PROPERTY_REGION'] = intval($_REQUEST['region']);
 
$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_REGION", "PROPERTY_CITY"), false);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

 if(strlen(trim($arFields['PROPERTY_CITY_VALUE'])) > 0) { 
	$arResult['CITY'][$arFields['PROPERTY_REGION_ENUM_ID']][] = $arFields['PROPERTY_CITY_VALUE'];
	
 }
}
?>