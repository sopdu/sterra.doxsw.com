<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$propuctsLines = array();
$rsGender = CUserFieldEnum::GetList(array(), array(
    "USER_FIELD_ID" => 7,
));
while ($ar = $rsGender->GetNext()) {
	$propuctsLines[$ar['ID']] = $ar;
}

$arResult['PRODUCT_LINES'] = $propuctsLines;
$arLinksCODE = Array();

foreach($arResult['SECTION'] as $key => $arSections){
	
	foreach($arSections['UF_CERTIFICATION'] as $key_cer => $items){
		
		$arSelect = Array("ID", "IBLOCK_ID",'DETAIL_PAGE_URL', "NAME");
		$arFilter = Array("ID"=>$items, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement()){ 
			
			$arFields = $ob->GetFields();
			$arResult['SECTION'][$key]['UF_CERTIFICATION'][$key_cer] = 	$arFields;
			
		}
	}
        $arLinksCODE[$arSections['IBLOCK_ID']][$arSections['ID']] = $key;
}

foreach ($arResult['SECTION'] as $key => $arSections){
        if (($arSections['DEPTH_LEVEL'] == '1') && (isset($arSections['UF_CURRENT_VERSION']))){
                $current_key = $arLinksCODE[$arSections['IBLOCK_ID']][$arSections['UF_CURRENT_VERSION']];
                $arResult['SECTION'][$key]['CURRENT_VERSION'] = $arResult['SECTION'][$current_key];
                
        }
        
}
?>