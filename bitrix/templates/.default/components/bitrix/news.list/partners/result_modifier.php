<?
$arFilter = Array('IBLOCK_ID'=>$arResult['ID'], 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
while($ar_result = $db_list->GetNext())
{
	$arResult['SECTION_ITEMS'][] = $ar_result;
}

$i = 0;
foreach($arResult['ITEMS'] as $arItems){

	$arItems['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItems['PREVIEW_PICTURE'], Array("width" => 90, "height" => 90));
	$arResult['ITEMS'][$i]['PREVIEW_PICTURE'] = $arItems['PREVIEW_PICTURE'];
	$i++;
}
?>