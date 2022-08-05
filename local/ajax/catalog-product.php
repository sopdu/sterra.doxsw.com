<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

$limit = ((int)$request->get("limit")>0 ? $request->get("limit") : 10);
$page = ((int)$request->get("page")>0 ? $request->get("page") : 1);
$offset = ( $page - 1 ) * $limit;

$arFilterStart = [
	"IBLOCK_ID"      => 7,
	"DEPTH_LEVEL"    => 2,
	"=ACTIVE"        => "Y",
	"=GLOBAL_ACTIVE" => "Y",
];

$arFilter = $arFilterStart;



if($request->get("filter_1") == "on") {
	$arFilter["UF_CERT_CLASS"][] = "%КС1%";
}
if($request->get("filter_2") == "on") {
	$arFilter["UF_CERT_CLASS"][] = "%КС2%";
}
if($request->get("filter_3") == "on") {
	$arFilter["UF_CERT_CLASS"][] = "%КС3%";
}
if($request->get("filter_4") == "on") {
	$arFilter["UF_CERT_CLASS"][] = "%МЭ%";
}

/*$arAdFilter = [];
if($request->get("filter_5") == "on") {
	$arAdFilter[] = 1;
}
if($request->get("filter_6") == "on") {
	$arAdFilter[] = 2;
}
if($request->get("filter_7") == "on") {
	$arAdFilter[] = 3;
}
if($request->get("filter_8") == "on") {
	$arAdFilter[] = 4;
}
if($request->get("filter_9") == "on") {
	$arAdFilter[] = 5;
}
if (count($arAdFilter)) {
	if(count($arAdFilter) == 1) {
		$arFilter["UF_NOMBRAMIENTOS"] = $arAdFilter[0];
	}
	else {
		$arAddition = [
			"LOGIC" => "AND",
		];
		foreach($arAdFilter as $id) {
			$arAddition[] = ["UF_NOMBRAMIENTOS" => $id];
		}
	}
	$arFilter[] = $arAddition;
}*/
if($request->get("filter_5") == "on") {
	$arFilter["UF_NOMBRAMIENTOS"][] = 1;
}
if($request->get("filter_6") == "on") {
	$arFilter["UF_NOMBRAMIENTOS"][] = 2;
}
if($request->get("filter_7") == "on") {
	$arFilter["UF_NOMBRAMIENTOS"][] = 3;
}
if($request->get("filter_8") == "on") {
	$arFilter["UF_NOMBRAMIENTOS"][] = 4;
}
if($request->get("filter_9") == "on") {
	$arFilter["UF_NOMBRAMIENTOS"][] = 5;
}


$filterCerts = [];
foreach ($_GET as $param => $val){
    if ($val != 'on') continue;
    $valArr = explode('cert-', $param);
    if (count($valArr) > 1) $filterCerts[] = $valArr[1];
}
if (count($filterCerts)){
    $arFilter[] = array(
        "LOGIC" => "OR",
        array("UF_CERT_CLASS" => $filterCerts),
        array("UF_CERT_FBI" => $filterCerts),
		array("UF_CERT_OTHER" => $filterCerts)
    );
}


if($request->get("query")!="null" && $request->get("query")!="") {
	$versionsDB = CIBlockSection::GetList(
	    Array('SORT' => 'ASC'),
	    Array('IBLOCK_ID' => $arFilter['IBLOCK_ID'], 'DEPTH_LEVEL' => 3, 'ACTIVE' => 'Y', 'UF_DESC' => "%".$request->get("query")."%"),
		false,
		Array('IBLOCK_SECTION_ID')
	);
	$productIDS = [];
	while ($version = $versionsDB->Fetch()) $productIDS[$version['IBLOCK_SECTION_ID']] = $version['IBLOCK_SECTION_ID'];


	$filter2 = $arFilter;
	$filter2[] = array(
		"LOGIC" => "OR",
		array("NAME" => "%".$request->get("query")."%"),
		array("UF_SHORT_DESCRIPTION" => "%".$request->get("query")."%"),
	);
	$productsDB = CIBlockSection::GetList(
		Array('SORT' => 'ASC'),
		$filter2,
		false,
		Array('ID')
	);
	while ($product = $productsDB->Fetch()) $productIDS[$product['ID']] = $product['ID'];
	$count = count($productIDS);
}


if (!$request->get("query") || $request->get("query")=="null" || $request->get("query")=="") {
	$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock(7);
	$rsSection = $entity::getList(
		[
			'filter' => $arFilter,
			'select' => ['CNT'],
			'runtime' => [
				new Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)')
			]
		]
	);
	$count = $rsSection->fetch()["CNT"];
}




if($request->get("query")!="null" && $request->get("query")!="") {
	$arFilter = $arFilterStart;
	$arFilter['ID'] = $productIDS;
}

$arItems = [];
$q = new \Bitrix\Main\Entity\Query(\Bitrix\Iblock\Model\Section::compileEntityByIblock(7));
$q
	->setSelect(
		[
			'ID',
			'CODE',
			'NAME',
			'DETAIL_PICTURE',
			'SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
			"UF_SHORT_DESCRIPTION",
			"UF_DESIGN",
			"UF_CERT_CLASS",
			"UF_CERT_FBI",
			"UF_CERT_OTHER",
			/*"UF_PRODUCTS_LINE",
			"UF_CERTIFICATION",
			"UF_DOCUMENT",
			"UF_CURRENT_VERSION",
			"UF_MENU_NAME",*/
			"UF_NOMBRAMIENTOS",
            "UF_IMG_LIST"
		]
	)
	->setFilter($arFilter)
    ->setOrder(Array('SORT' => 'ASC'))
	->setLimit($limit)
	->setOffset($offset);
$rsSection = $q->exec();

while( $arSection = $rsSection->fetch() ) {
	$arItem = [
		"title" => $arSection['NAME'],
		"description" => ($arSection['UF_SHORT_DESCRIPTION'] ? $arSection['UF_SHORT_DESCRIPTION'] : ""),
		"available" => true,
		"href" => str_replace(["#SITE_DIR#", "#SECTION_CODE#"], ["", $arSection['CODE']], $arSection['SECTION_PAGE_URL']),
		"blocks" => [],
		"icon" => CFile::GetPath($arSection['UF_IMG_LIST'])
	];
	if ($arSection['UF_DESIGN'][0] != "") {
		$arItem["blocks"][] = [
			"title" => "Исполнения",
			"value" => $arSection['UF_DESIGN'],
		];
	}
	if ($arSection['UF_CERT_CLASS'] != "" || $arSection['UF_CERT_FBI']) {
	    $val = '';
		if (count($arSection['UF_CERT_FBI'])) {
			$val .= 'ФСБ: ';
			$first = true;
			foreach ($arSection['UF_CERT_FBI'] as $cert) {
				if (!$first) $val.=', ';
				$val .= $cert;
				if ($first) $first = false;
			}
			$val.='<br>';
		}
	    if (count($arSection['UF_CERT_CLASS'])) {
            $val .= 'ФСТЭК: ';
            $first = true;
            foreach ($arSection['UF_CERT_CLASS'] as $cert) {
                if (!$first) $val.=', ';
                $val .= $cert;
                if ($first) $first = false;
            }
			$val.='<br>';
        }

		if (count($arSection['UF_CERT_OTHER'])) {
			$first = true;
			foreach ($arSection['UF_CERT_OTHER'] as $cert) {
				if (!$first) $val.=', ';
				$val .= $cert;
				if ($first) $first = false;
			}
		}

        if ($val) {
            $arItem["blocks"][] = [
                "title" => "Сертификация",
                "value" => $val,
            ];
        }
	}
	$arItems[] = $arItem;
}

$result = [
	"items" => $arItems,
	"size" => $count
];
echo json_encode($result);


?>

