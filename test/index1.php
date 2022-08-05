<?
/*require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Title");
*/?><!--
	<h1>Title Here</h1>
	<br>
	<p>
		Text Here...
	</p>


--><?/**/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/*$count = \Bitrix\Iblock\ElementTable::getCount(
	[
		'=IBLOCK_ID'            => $IBLOCK_CATALOG_ID,
		'=WF_PARENT_ELEMENT_ID' => null,
	]
);*/

/*$res =  \Bitrix\Iblock\ElementTable::getList(["filter" => ["IBLOCK_ID" => 46, "=ACTIVE" => "Y"]]);
while ( $arEl = $res->fetch() ) {
	 echo "<pre>"; print_r($arEl); echo "</pre>";
}*/

//http://sterra.doxsw.com/company/awards_and_appreciation/backend/awards.json?query=null&filter_type=2&page=2


$arFilter = [ "IBLOCK_ID" => 26, "=ACTIVE" => "Y" ];

$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
$arItems = [];
$listres = \CIBlockElement::GetList(
	["sort" => "desc"],
	$arFilter,
	false,
	["nPageSize" => 8, "iNumPage" => 2/*$request->get("page")*/],
	["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
);
while ( $arEl = $listres->GetNext() ) {
	$arClearEl["title"] = $arEl["NAME"];
	$arClearEl["description"] = $arEl["PREVIEW_TEXT"];
	switch($arEl["IBLOCK_ID"]) {
		case 26:
			$arClearEl["type"] = 1;
			break;
		case 27:
			$arClearEl["type"] = 2;
			break;
	}
	$arClearEl["image"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"])["SRC"];
	$arClearEl["link"] = $arEl["DETAIL_PAGE_URL"];
	$arItems[] = $arClearEl;
}
$result = [
	"items" => $arItems,
	"size" => $count
];
 echo "<pre>"; print_r($result); echo "</pre>";


die();


$obCache = new \CPHPCache();
if( $obCache->InitCache((60*60*24), "home_news_slider" )) {
	$arSolutions = $obCache->GetVars();
}
else {
	$obCache->StartDataCache();
	$arPress = [];
	$listres = \CIBlockElement::GetList(
		["active_from" => "desc"],
		[ "IBLOCK_ID" => [1,11,36], "=ACTIVE" => "Y" ],
		false,
		false, //["nPageSize"=>10],
		["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "ACTIVE_FROM", "DETAIL_PAGE_URL"]
	);
	while ( $arEl = $listres->GetNext() ) {
		$arClearEl["NAME"] = $arEl["NAME"];
		$arClearEl["ACTIVE_FROM"] = $arEl["ACTIVE_FROM"];
		$arClearEl["PREVIEW_TEXT"] = $arEl["PREVIEW_TEXT"];
		$arClearEl["DETAIL_PICTURE"] = \CFile::GetFileArray($arEl["DETAIL_PICTURE"]);
		$arClearEl["DETAIL_PAGE_URL"] = $arEl["DETAIL_PAGE_URL"];
		switch($arEl["IBLOCK_ID"]) {
			case 1:
				$arClearEl["TYPE"] = "news";
				break;
			case 11:
				$arClearEl["TYPE"] = "events";
				break;
			case 36:
				$arClearEl["TYPE"] = "updates";
				break;
		}
		$arPress[] = $arClearEl;
	}
	$obCache->EndDataCache($arSolutions);
}


 echo "<pre>"; print_r($arPress); echo "</pre>";






echo "________________________________________________________________________";   die();

$obCache = new \CPHPCache();
if( $obCache->InitCache((60*60*24), "home_solutions_slider" )) {
	$arSolutions = $obCache->GetVars();
}
else {
	$obCache->StartDataCache();
	$arSectSolutions = [];
	$arCompSolutions = [];
	$listres = \CIBlockElement::GetList(
		["sort" => "asc"],
		[ "IBLOCK_ID" => 46, "=ACTIVE" => "Y" ],
		false,
		false, //["nPageSize"=>10],
		["NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
	);
	while ( $arEl = $listres->GetNext() ) {
		$arClearEl["NAME"] = $arEl["NAME"];
		$arClearEl["PREVIEW_TEXT"] = $arEl["PREVIEW_TEXT"];
		$arClearEl["PREVIEW_PICTURE"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"]);
		$arClearEl["DETAIL_PAGE_URL"] = $arEl["DETAIL_PAGE_URL"];
		$arClearEl["TYPE"] = "sector";
		$arSectSolutions[] = $arClearEl;
	}
	$listres = \CIBlockElement::GetList(
		["sort" => "asc"],
		[ "IBLOCK_ID" => 18, "=ACTIVE" => "Y" ],
		false,
		false, //["nPageSize"=>10],
		["NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]
	);
	while ( $arEl = $listres->GetNext() ) {
		$arClearEl["NAME"] = $arEl["NAME"];
		$arClearEl["PREVIEW_TEXT"] = $arEl["PREVIEW_TEXT"];
		$arClearEl["PREVIEW_PICTURE"] = \CFile::GetFileArray($arEl["PREVIEW_PICTURE"]);
		$arClearEl["DETAIL_PAGE_URL"] = $arEl["DETAIL_PAGE_URL"];
		$arClearEl["TYPE"] = "complex";
		$arCompSolutions[] = $arClearEl;
	}
	$arSolutions = [];
	$c = count($arCompSolutions);
	for($i = 0; $i<$c; $i++) { echo count($arCompSolutions)." ++ ".$i;
		if (isset($arCompSolutions[$i])) {
			$arSolutions[] = $arCompSolutions[$i];
			unset($arCompSolutions[$i]);
		}
		if (isset($arSectSolutions[$i])) {
			$arSolutions[] = $arSectSolutions[$i];
			unset($arSectSolutions[$i]);
		}
	}
	$obCache->EndDataCache($arSolutions);
}




 echo "<pre>"; print_r($arSolutions); echo "</pre>";



?>


<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>