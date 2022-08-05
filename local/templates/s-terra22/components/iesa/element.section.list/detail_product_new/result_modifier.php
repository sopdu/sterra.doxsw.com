<?
if(!function_exists("my_ofset")) {
    function my_ofset($text){
        preg_match('/^\D*(?=\d)/', $text, $m);
        return isset($m[0]) ? strlen($m[0]) : false;
    }
}

foreach($arResult['ITEMS'] as $key => $arItems){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=> $arItems['PROPERTIES']['MODEL']['LINK_IBLOCK_ID'], 'ID' => $arItems['PROPERTIES']['MODEL']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
	while($ob = $res->GetNext())
	{	
		$arModel[] = $ob;
		
	}
	
	$arResult['ITEMS'][$key]['PROPERTIES']['MODEL']['ELEMENTS'] = $arModel;	
}

foreach($arResult['ITEMS'] as $key => $arItems){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=> $arItems['PROPERTIES']['CERTIFICATION']['LINK_IBLOCK_ID'], 'ID' => $arItems['PROPERTIES']['CERTIFICATION']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter,  $arSelect);
	while($ob = $res->GetNext())
	{	
		$arCert[] = $ob;
		
	}
	
	$res = CIBlockElement::GetByID($arItems['PROPERTIES']['DOCUMINTATION']['VALUE']);
	if($ar_res = $res->GetNext())
		$arItems['PROPERTIES']['DOCUMINTATION']['VALUE'] = $ar_res;
	
	$arResult['ITEMS'][$key]['PROPERTIES']['DOCUMINTATION'] = $arItems['PROPERTIES']['DOCUMINTATION']['VALUE'];
	
	$arResult['ITEMS'][$key]['PROPERTIES']['CERTIFICATION']['ELEMENTS'] = $arCert;	
}

foreach($arResult['SECTION'] as $key => $arSection){
        if (($arSection['DEPTH_LEVEL'] == 2) && (isset($arSection['IBLOCK_SECTION_ID']))){
                $arSectionFilter = Array("IBLOCK_ID" => PRODUCTS_IB, "ID" => $arSection['IBLOCK_SECTION_ID'], 'GLOBAL_ACTIVE'=>'Y');
                $arSelectFilter =  Array("");
                $Sectionlist = CIBlockSection::GetList(Array("timestamp_x"=>"DESC"), $arSectionFilter, false, $arSelectFilter);
                $res = Array();
                while($arSectionResult = $Sectionlist->GetNext())
                {
                        $res = $arSectionResult;
                }
                $arResult['SECTION'][$key]['PARENT'] = $res;
        }
        
}

preg_match_all('/\#\bORDER_BUTTON\b\#/', $arResult['SECTION'][0]['DESCRIPTION'], $matches);
if (is_array($matches)) {
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    print_r("<div style='display: none;' class='href-info'>".$uri_segments[3]."</div>");

    $oldstr = $arResult['SECTION'][0]['NAME'];
    $pos = my_ofset($oldstr) - 1;
    $newstr = substr($oldstr, 0, $pos) . ', версия' . substr($oldstr, $pos);
    print_r("<div style='display: none;' class='href-name'>".$newstr."</div>");
}
?>