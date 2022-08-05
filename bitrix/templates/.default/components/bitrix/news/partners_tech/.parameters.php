<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arFilter = array('IBLOCK_ID' => TECH_PARTNERS); 
   $rsSect = CIBlockSection::GetList(array(),$arFilter);
   $arSection = array();
   $arSection[''] = '-'; 
   while ($arSect = $rsSect->GetNext())
   {
       $arSection[$arSect['ID']] = $arSect['NAME'];
   }

$arTemplateParameters = Array(
		"IBLOCK_SECTION" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_SECTION"),
			"TYPE" => "LIST",
			"VALUES" => $arSection,
			"DEFAULT" => "",			
		),	
	);
?>