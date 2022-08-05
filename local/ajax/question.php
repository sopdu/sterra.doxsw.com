<?php
define("LANGUAGE_ID", "s1"); // ID сайта
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
//require_once ($_SERVER["DOCUMENT_ROOT"]."/local/ajax/captha.php");
//include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");


function dump($value){
    $filePath = $_SERVER["DOCUMENT_ROOT"].'/ilsDump.txt';
    $file = fopen($filePath, "w");
    fwrite($file, print_r($value, 1));
    #fclose(); // не удалять - надо тестировать
    return;
}


if($APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_code"])) {

    if(!empty($_REQUEST)) {
        //dump($_REQUEST);
    }

    $name = htmlspecialchars($_REQUEST["name"]);
    $company = htmlspecialchars($_REQUEST["company"]);
    $email = htmlspecialchars($_REQUEST["email"]);
    $phone = htmlspecialchars($_REQUEST["phone"]);
    $question = htmlspecialchars($_REQUEST["question"]);

    CModule::IncludeModule("iblock");
    $eventName = "NEW_QUESTION"; // название события
    $arFields = [
        "NAME" => $name,
        "COMPANY" => $company,
        "EMAIL" => $email,
        "PHONE" => $phone,
        "QUESTION" => $question,
    ];
    $event = new CEvent;
    if (!$event->Send($eventName, LANGUAGE_ID, $arFields, "N")) {
        echo '{
          "success": false
            }';
    } else {
        echo '{
      "success": true
    }';
    }
}

?>