<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent("bitrix:main.register", "registration", array(
	"SHOW_FIELDS" => array(
		0 => "NAME",
		1 => "SECOND_NAME",
		2 => "LAST_NAME",
	),
	"REQUIRED_FIELDS" => array(
	),
	"AUTH" => "Y",
	"USE_BACKURL" => "Y",
	"SUCCESS_PAGE" => "",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
	),
	"USER_PROPERTY_NAME" => ""
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>