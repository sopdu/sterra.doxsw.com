<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

CModule::IncludeModule('iblock');

if (empty($_SESSION['subscribe_email']) && !empty($_COOKIE['BITRIX_SM_subscribe_email'])) {
    $_SESSION['subscribe_email'] = $_COOKIE['BITRIX_SM_subscribe_email'];
}

function getSubscribe($userId = "", $userMail = "", $subscribeId = 3)
{

    $arSelect = array("ID", "NAME", "PROPERTY_EMAIL");
    $arFilter = array("IBLOCK_ID"=>42, "ACTIVE"=>"Y", "PROPERTY_EMAIL" => trim($userMail));
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), $arSelect);
    if ($ob = $res->GetNextElement()) {
        echo 1;
    } else {
        echo 0;
    }
}

if (!empty($_SESSION['subscribe_email'])) {
    getSubscribe('', $_SESSION['subscribe_email']);
} else {
    echo 0;
}
