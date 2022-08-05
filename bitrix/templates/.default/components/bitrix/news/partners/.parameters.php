<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arFilter = array('IBLOCK_ID' => BUSINESS_PARTNERS); 
   $rsSect = CIBlockSection::GetList(array(),$arFilter);
   while ($arSect = $rsSect->GetNext())
   {
       $arSectiom[$arSect['ID']] = $arSect['NAME'];
   }

$arTemplateParameters = Array(
		"IBLOCK_SECTION" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_SECTION"),
			"TYPE" => "LIST",
			"VALUES" => $arSectiom,
			"DEFAULT" => "",			
		),	
	);
?>