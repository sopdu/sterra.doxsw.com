<?

$arFilter = Array('IBLOCK_ID'=>$arResult['ID'], 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);

while($ar_result = $db_list->GetNext())
{
	$arResult['SECTION'][] = $ar_result;
}

?>