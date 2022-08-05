<?php

define("LANGUAGE_ID", "s1"); // ID сайта
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$name = htmlspecialchars($_REQUEST["name"]);
$company = htmlspecialchars($_REQUEST["company"]);
$email = htmlspecialchars($_REQUEST["email"]);
$phone = htmlspecialchars($_REQUEST["phone"]);
$comment = htmlspecialchars($_REQUEST["comment"]);

CModule::IncludeModule("iblock");
$eventName = "NEW_CONSULT_REQUEST"; // название события
$arFields = [
	"NAME" => $name,
	"COMPANY" => $company,
	"EMAIL" => $email,
	"PHONE" => $phone,
	"COMMENT" => $comment,
];
$event = new CEvent;
if( !$event->Send($eventName, LANGUAGE_ID, $arFields, "N") ) {
	echo '{
  "success": false
}';
}
else {
	echo '{
  "success": true
}';
}

?>