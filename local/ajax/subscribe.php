<?php

define("LANGUAGE_ID", "s1"); // ID сайта
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$company = htmlspecialchars($_REQUEST["company"]);
$email = htmlspecialchars($_REQUEST["email"]);

CModule::IncludeModule("iblock");
$eventName = "SUBSCRIBE_REQUEST"; // название события
$arFields = [
    "COMPANY" => $company,
    "EMAIL" => $email,
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