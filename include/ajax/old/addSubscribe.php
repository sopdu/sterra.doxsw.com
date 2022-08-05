<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

global $USER;

$msg = array();

if (!empty($_POST['name']) && !empty($_POST['email']) && empty($_SESSION['subscribe_email'])) {
    $arFields = array(
        // "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
        "USER_ID" => false, //Чтоб два раза не регались авторизованный и неавторизованный
        "FORMAT" => "html",
        "EMAIL" => $_POST['email'],
        "ACTIVE" => "Y",
        "SEND_CONFIRM" => "N",
        "CONFIRMED" => "Y",
        "RUB_ID" => array(3)
    );

    CModule::IncludeModule('subscribe');
    $subscr = new CSubscription;

    //can add without authorization
    $ID = $subscr->Add($arFields);
    
    if ($ID>0) {
        $_SESSION['subscribe_email'] = $_POST['email'];
        $msg['status'] = 1;
        $msg['message'] = 'Вы успешно подписаны на рассылку!';
    } else {
        $msg['status'] = 0;
        $msg['message'] = strip_tags($subscr->LAST_ERROR);
    }
} else {
    $msg['status'] = 0;
    if (!empty($_SESSION['subscribe_email'])) {
        $msg['message'] = 'Вы уже подписывались на эту рассылку';
    } else {
        $msg['message'] = 'Пожалуйста заполните все поля';
    }
}

echo json_encode($msg);
