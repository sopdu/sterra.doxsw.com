<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/submebuSecondLevelAsThirdForOther.css", true);
$APPLICATION->SetTitle("Часто задаваемые вопросы (FAQ)");

?>

<?$APPLICATION->IncludeComponent("iesa:faq.list", "faq.list", Array(
	"IBLOCK_TYPE" => "news",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "16",	// Код информационного блока
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y"
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>