<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог продуктов");
$APPLICATION->SetAdditionalCSS("/local/template_files/css/style_new_icons.css");

	$arSect = array();
	$arFilter = Array('CODE'=>$_REQUEST['code'], 'ACTIVE'=>'Y');
	$sect = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL'));
	if($ar_result = $sect->GetNext())
	{
		$arSect = $ar_result['ID'];
		$name = $ar_result['NAME'];
	}

		if ((($ar_result['DEPTH_LEVEL'] >1))  && (isset($ar_result['IBLOCK_SECTION_ID']))){
                $arSectionFilter = Array("IBLOCK_ID" => PRODUCTS_IB, "ID" => $ar_result['IBLOCK_SECTION_ID'], 'GLOBAL_ACTIVE'=>'Y');
                $arSelectFilter =  Array("UF_CURRENT_VERSION", "NAME", 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL');
                $Sectionlist = CIBlockSection::GetList(Array("timestamp_x"=>"DESC"), $arSectionFilter, false, $arSelectFilter);
                if($arSectionResult = $Sectionlist->GetNext())
                {
                        $nextBLock = CIBlockSection::GetByID($arSectionResult['IBLOCK_SECTION_ID']);
                        if ($nextBlock_res = $nextBLock->GetNext()){
							$arSectionFilter = Array("IBLOCK_ID" => PRODUCTS_IB, "ID" => $ar_result['UF_CURRENT_VERSION'], 'GLOBAL_ACTIVE'=>'Y');
                			$arSelectFilter =  Array("UF_CURRENT_VERSION", "NAME", 'IBLOCK_SECTION_ID', 'ID', 'SECTION_PAGE_URL');
                			$Sectionlist = CIBlockSection::GetList(Array("timestamp_x"=>"DESC"), $arSectionFilter, false, $arSelectFilter);
							//print_r($Sectionlist->GetNext());
                			while ($nextarSectionResult2 = $Sectionlist->GetNextElement())
                			{

$nextNextBlock_res2 = $nextarSectionResult2->GetFields();
								//print_r($nextNextBlock_res2['ID']);
								//print_r($ar_result['IBLOCK_SECTION_ID']);
								if ($nextNextBlock_res2['ID'] == $ar_result['IBLOCK_SECTION_ID']){
										$spu = $nextNextBlock_res2['SECTION_PAGE_URL'];
										break;
									}

                			}

							//print_r($spu);

							//print_r($nextBlock_res);
							$arSectionFilter = Array("IBLOCK_ID" => PRODUCTS_IB, "ID" => $nextBlock_res['IBLOCK_SECTION_ID'], 'GLOBAL_ACTIVE'=>'Y');
                			$arSelectFilter =  Array("UF_CURRENT_VERSION", "NAME", 'IBLOCK_SECTION_ID', 'ID');
                			$Sectionlist = CIBlockSection::GetList(Array("timestamp_x"=>"DESC"), $arSectionFilter, false, $arSelectFilter);
							//print_r($Sectionlist->GetNext());
                			if($nextarSectionResult = $Sectionlist->GetNext())
                			{
								//print_r($nextarSectionResult['ID']);
                        		$nextNextBLock = CIBlockSection::GetByID(148);
                        		if ($nextNextBlock_res = $nextNextBLock->GetNext()){
							//print_r($nextNextBlock_res['IBLOCK_SECTION_ID']);
							//print_r($nextNextBlock_res);
                                	$APPLICATION->AddChainItem($nextNextBlock_res['NAME'],$nextNextBlock_res['SECTION_PAGE_URL']);
                        		}
                			}


                            $APPLICATION->AddChainItem($arSectionResult['NAME'],$spu);

							//print_r($arSectionResult);

						}else{
                            $APPLICATION->AddChainItem($arSectionResult['NAME'],$arSectionResult['SECTION_PAGE_URL']);

						}
                }
        }

	$APPLICATION->SetTitle($name);
	$APPLICATION->AddChainItem($name);
?>

<?

$arSectionFilter = Array("IBLOCK_ID" => PRODUCTS_IB, "ID" => $arSect, 'GLOBAL_ACTIVE'=>'Y');
$Sectionlist = CIBlockSection::GetList(Array("timestamp_x"=>"DESC"), $arSectionFilter, false, Array("UF_CURRENT_VERSION", "DEPTH_LEVEL", "ID"));
$arResult = Array();
//print_r($arSectionFilter);
while($arSectionResult = $Sectionlist->GetNext())
{
    $arResult[] = $arSectionResult;
}

if (($arResult[0]['ID'] == $arSect) && ($arResult[0]['DEPTH_LEVEL'] == "1" || $arResult[0]['DEPTH_LEVEL'] == "2") && (isset($arResult[0]['UF_CURRENT_VERSION']))){
    $current_version_res = CIBlockSection::GetByID($arResult[0]['UF_CURRENT_VERSION']);
    if ($current_version_ar_res = $current_version_res->GetNext()){
        $next_url = $current_version_ar_res['SECTION_PAGE_URL'];
        LocalRedirect($next_url);
    }

}
?>

<?
if (!is_array($arSect)){
$APPLICATION->IncludeComponent(
	"iesa:element.section.list", 
	"detail_product_new", 
	array(
		"IBLOCK_TYPE" => "products",
		"IBLOCK_ID" => "7",
		"SECTION_ID" => array(
			0 => "",
			1 => $arSect,
			2 => "",
		),
		"COUNT" => "30",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "NOMBRAMIENTOS",
			1 => "PRODUCT_LINE",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PAGER_TITLE" => "Секции и элементы",
		"COMPONENT_TEMPLATE" => "detail_product_new"
	),
	false
);
}else{
	global $APPLICATION;
    $APPLICATION->RestartBuffer();
    CHTTP::SetStatus("404 Not Found");
	include($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/404_s-terra/header.php");
}
?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>