<?
$arFilter = Array('IBLOCK_ID'=>$arResult['ID'], 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
while($ar_result = $db_list->GetNext())
{
	$arResult['SECTION_ITEMS'][] = $ar_result;
}

foreach($arResult['ITEMS'] as $key => $arItem){
	$arResult['ITEMS'][$key]['ORIG_PICTURE'] = $arItem['PREVIEW_PICTURE'];
	$arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 92, "height" => 122), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'];
}

?>