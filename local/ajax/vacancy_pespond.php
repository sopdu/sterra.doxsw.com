<?php

define("SITE_ID", "s1"); // ID сайта
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$name = htmlspecialchars($_REQUEST["name"]);
$yearold = htmlspecialchars($_REQUEST["yearold"]);
$city = htmlspecialchars($_REQUEST["city"]);
$email = htmlspecialchars($_REQUEST["email"]);
$phone = htmlspecialchars($_REQUEST["phone"]);
$comment = htmlspecialchars($_REQUEST["comment"]);

/*echo '$_REQUEST = <pre>'; print_r($_REQUEST); echo "</pre>";
echo '$_REQUEST[\'attachment\'] = <pre>'; var_dump($_REQUEST['attachment']); echo "</pre>";
echo '$_FILES = <pre>'; print_r($_FILES); echo "</pre>";  die();*/

CModule::IncludeModule("iblock");
$eventName = "NEW_VACANCY_RESPONSE"; // название события
$arFields = [
	"NAME" => $name,
	"YEAROLD" => $yearold,
	"CITY" => $city,
	"EMAIL" => $email,
	"PHONE" => $phone,
	"COMMENT" => $comment,
];
$arFiles=[];
$event = new CEvent;
if( !$event->Send($eventName, SITE_ID, $arFields, "N", "", $arFiles, "ru") ) {
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