<?

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

$arFilter = [ "IBLOCK_ID" => $arParams["IBLOCK_ID"], "=ACTIVE" => "Y" ];

$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$arItems = [];
$listres = \CIBlockElement::GetList(
	["sort" => "desc", "CREATED_DATE" => "desc"],
	$arFilter,
	false,
	false,
	["ID", "IBLOCK_ID", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arItems[] = $arEl["DETAIL_PAGE_URL"];
}
$key = array_search($arResult["DETAIL_PAGE_URL"], $arItems);
$nextKey = $key+1;
$prevKey = $key-1;
if($prevKey < 0) {
	$arResult["PREV_ELEMENT"] = "javascript:void(0);";
}
else {
	$arResult["PREV_ELEMENT"] = $arItems[$prevKey];
}
if($nextKey >= count($arItems)) {
	$arResult["NEXT_ELEMENT"] = "javascript:void(0);";
}
else {
	$arResult["NEXT_ELEMENT"] = $arItems[$nextKey];
}

$arResult["IMAGES"] = [];
if(isset( $arResult['DETAIL_PICTURE']['SRC']))
	$arResult["IMAGES"][] = $arResult['DETAIL_PICTURE']['SRC'];
elseif(isset($arResult['PREVIEW_PICTURE']['SRC']))
	$arResult["IMAGES"][] = $arResult['PREVIEW_PICTURE']['SRC'];
if(count($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'])) {
	foreach($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE'] as $img) {
		$arResult["IMAGES"][] = CFile::GetPath($img);
	}
}
?>
