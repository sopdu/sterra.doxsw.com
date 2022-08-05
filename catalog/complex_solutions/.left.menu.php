<?
$aMenuLinks = Array();
CModule::IncludeModule('iblock');
$items = CIBlockElement::GetList(
    Array('SORT' => 'ASC'),
    Array('IBLOCK_ID' => 18, 'ACTIVE' => 'Y'),
    false,
    false,
    Array('NAME', 'CODE')
);
while ($item = $items->Fetch()){
    $aMenuLinks[] = Array(
        $item['NAME'],
        "/catalog/complex_solutions/".$item['CODE']."/",
        Array(),
        Array(),
        ""
    );
}

/*$aMenuLinks = Array(
	Array(
		"Защита канала 10 Гбит и больше",
		"/catalog/complex_solutions/zashchita-vysokoproizvoditelnykh-kanalov/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита подключения к ИС ЕПТ",
		"/catalog/complex_solutions/zashchita-podklyucheniya-k-is-ept/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита удаленного доступа",
		"/catalog/complex_solutions/zashchita-udalennogo-dostupa/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита персональных данных",
		"/catalog/complex_solutions/zashchita-personalnykh-dannykh/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита КИИ",
		"/catalog/complex_solutions/zashchita-kii/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита виртуализации",
		"/catalog/complex_solutions/zashchita-virtualizatsii/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита подключения к СМЭВ",
		"/catalog/complex_solutions/zashchita-podklyucheniya-k-smev/",
		Array(),
		Array(),
		""
	),
	Array(
		"Обнаружение вторжений",
		"/catalog/complex_solutions/obnaruzhenie-setevykh-atak/",
		Array(),
		Array(),
		""
	),
	Array(
		"Защита межфилиальных взаимодействий",
		"/catalog/complex_solutions/zashchita-mezhfilialnykh-vzaimodeystviy/",
		Array(),
		Array(),
		""
	),
);*/
?>