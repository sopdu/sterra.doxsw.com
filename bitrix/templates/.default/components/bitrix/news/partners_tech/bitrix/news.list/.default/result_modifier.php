<?
$arFilter = Array('IBLOCK_ID'=>$arResult['ID'], 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
while($ar_result = $db_list->GetNext())
{
	$arResult['SECTION_ITEMS'][] = $ar_result;
}

foreach($arResult['ITEMS'] as $key => $arItems){

	$arItems['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItems['PREVIEW_PICTURE'], Array("width" => 90, "height" => 90));
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItems['PREVIEW_PICTURE'];
	
}



if(!empty($arParams['IBLOCK_SECTION'])){
	foreach($arResult['ITEMS'] as $key => $arItems){

		if($arItems['IBLOCK_SECTION_ID'] == $arParams['IBLOCK_SECTION']){
			
			$arResult['ITEMS'][$key] = $arItems;
		}else{
		
			unset($arResult['ITEMS'][$key]);
		}
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
 
$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_CITY"), false);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 if(strlen(trim($arFields['PROPERTY_CITY_VALUE'])) > 0)
	$arResult['CITY'][] = $arFields['PROPERTY_CITY_VALUE'];
}
?>