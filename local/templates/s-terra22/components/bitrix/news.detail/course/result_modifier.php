<?

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

$arFilter = [ "IBLOCK_ID" => 23, "ID" => $arResult['PROPERTIES']['MORE_COURSE']['VALUE'], "sort"=> "ask", "=ACTIVE" => "Y" ];

$arResult["MORE"] = [];
$listres = \CIBlockElement::GetList(
	["sort" => "ask"],
	$arFilter,
	false,
	false,
	["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["NAME"] = $arEl["NAME"];
	$res = CIBlockElement::GetProperty($arEl["IBLOCK_ID"], $arEl["ID"], "sort", "asc");
	while ($ob = $res->GetNext()) {
	}
	$arClearEl["REF"] = $arEl["DETAIL_PAGE_URL"];
	$arResult["MORE"][] = $arClearEl;
}
shuffle($arResult["MORE"]);
$arResult["MORE"] = array_slice($arResult["MORE"], 0,3);
$arResult["NAME"] = htmlspecialchars_decode($arResult["NAME"]);
?>
