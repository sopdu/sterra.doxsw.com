<?

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

$arFilter = [ "IBLOCK_ID" => 4, "ID" => $arResult['PROPERTIES']['MORE_VACANCIES']['VALUE'], "=ACTIVE" => "Y" ];

$arResult["MORE"] = [];
$listres = \CIBlockElement::GetList(
	["sort" => "desc", "CREATED_DATE" => "desc"],
	$arFilter,
	false,
	false,
	["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["NAME"] = $arEl["NAME"];
	$arClearEl["CITY"] = "";
	$res = CIBlockElement::GetProperty($arEl["IBLOCK_ID"], $arEl["ID"], "sort", "asc", ["CODE" => "CITY"]);
	while ($ob = $res->GetNext()) {
		$arClearEl["CITY"] .= ($arClearEl["CITY"]!="" ? " / " : "").$ob["VALUE_ENUM"];
	}
	$arClearEl["REF"] = $arEl["DETAIL_PAGE_URL"];
	$arResult["MORE"][] = $arClearEl;
}
shuffle($arResult["MORE"]);
$arResult["MORE"] = array_slice($arResult["MORE"], 0,3);

?>
