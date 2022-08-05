<?
	$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "DETAIL_PAGE_URL",  "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>PRODUCTS_IB , "ACTIVE"=>"Y");

	$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
	$i = 0;
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arProperties = $ob->GetProperties();
		
		$arResult['ITEMS'][$i] = $arFields; 
		$arResult['ITEMS'][$i]['PROPERTIES'] = $arProperties;
		$i++;
	}
?>