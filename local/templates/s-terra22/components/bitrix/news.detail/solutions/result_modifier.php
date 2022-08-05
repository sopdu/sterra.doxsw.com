<?
\Bitrix\Main\Loader::includeModule('iblock');

// connected products
$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock(7);
$rsSection = $entity::getList(
	[
		'filter' => [
			'IBLOCK_ID'   => 7,
			'ID' => $arResult["PROPERTIES"]["PRODUCTS"]["VALUE"],
			"=ACTIVE" => "Y",
			"=GLOBAL_ACTIVE" => "Y",
			"DEPTH_LEVEL" => 2
		],
		'select' => [
			'ID',
			'CODE',
			'NAME',
			'DETAIL_PICTURE',
			'DEPTH_LEVEL',
			'SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
			"UF_SHORT_DESCRIPTION",
			"UF_DESIGN",
			"UF_CERT_CLASS",
			"UF_CERT_FBI",
			"UF_CERT_OTHER",
			"UF_IMG_LIST"
			/*"UF_PRODUCTS_LINE",
			"UF_CERTIFICATION",
			"UF_DOCUMENT",
			"UF_CURRENT_VERSION",
			"UF_MENU_NAME",*/
		],
	]
);
while( $arSection = $rsSection->fetch() ) {
	$arSection['URL'] = str_replace(["#SITE_DIR#","#SECTION_CODE#"],["",$arSection['CODE']],$arSection['SECTION_PAGE_URL']);
	$arSection['ICON'] = CFile::GetPath($arSection['UF_IMG_LIST']);
	$arResult["PRODUCTS"][] = $arSection;
}


?>
