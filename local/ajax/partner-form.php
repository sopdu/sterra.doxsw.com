<?php

define("LANGUAGE_ID", "s1"); // ID сайта
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$name = htmlspecialchars($_REQUEST["name"]);
$position = htmlspecialchars($_REQUEST["position"]);
$company = htmlspecialchars($_REQUEST["company"]);
$email = htmlspecialchars($_REQUEST["email"]);
$phone = htmlspecialchars($_REQUEST["phone"]);
$numberinn = htmlspecialchars($_REQUEST["numberinn"]);
$question = htmlspecialchars($_REQUEST["question"]);

CModule::IncludeModule("iblock");
$eventName = "NEW_PARTNER_REQUEST"; // название события
$arFields = [
    "NAME" => $name,
    "COMPANY" => $company,
    "POSITION" => $position,
    "EMAIL" => $email,
    "PHONE" => $phone,
    "INN" => $numberinn,
    "QUESTION" => $question,
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