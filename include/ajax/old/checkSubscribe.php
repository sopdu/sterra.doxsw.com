<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// global $USER;
CModule::IncludeModule('iblock');

function getSubscribe($userId = "", $userMail = "", $subscribeId = 3)
{

    $arSelect = array("ID", "NAME", "PREVIEW_TEXT");
    $arFilter = array("IBLOCK_ID"=>42, "ACTIVE"=>"Y", "PREVIEW_TEXT" => trim($userMail));
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), $arSelect);
    if ($ob = $res->GetNextElement()) {
        echo 1;
    } else {
        echo 0;
    }

/*
    $filter = array();
    if (!empty($userId)) {
        $filter = array("RUBRIC"=>$subscribeId, "CONFIRMED"=>"Y", "ACTIVE"=>"Y", "USER_ID"=>$userId);
    } else {
        if (!empty($userMail)) {
            $filter = array("RUBRIC"=>$subscribeId, "CONFIRMED"=>"Y", "ACTIVE"=>"Y", "EMAIL"=>$userMail);
        }
    }

    if (!empty($filter)) {
        $subscr = CSubscription::GetList(
            array("ID"=>"ASC"),
            $filter
        );

        if (($subscr_arr = $subscr->Fetch())) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
*/
}

/*
if ($USER->IsAuthorized()) {
    getSubscribe($USER->GetId());
} else {
    if (!empty($_SESSION['subscribe_email'])) {
        getSubscribe('', $_SESSION['subscribe_email']);
    } else {
        echo 0;
    }
}
*/
if (!empty($_SESSION['subscribe_email'])) {
        getSubscribe('', $_SESSION['subscribe_email']);
} else {
        echo 0;
}
