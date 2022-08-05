<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$msg = array();

if (empty($_SESSION['subscribe_email']) && !empty($_COOKIE['BITRIX_SM_subscribe_email'])) {
    $_SESSION['subscribe_email'] = $_COOKIE['BITRIX_SM_subscribe_email'];
}

if (!empty($_POST['name']) && !empty($_POST['email']) && empty($_SESSION['subscribe_email'])) {
    CModule::IncludeModule('iblock');

    $arSelect = array("ID", "NAME", "PROPERTY_EMAIL");
    $arFilter = array("IBLOCK_ID"=>42, "ACTIVE"=>"Y", "PROPERTY_EMAIL" => trim($_POST['email']));
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), $arSelect);
    if ($ob = $res->GetNextElement()) {
        $msg['status'] = 0;
        $msg['message'] = "Вы уже подписаны на нашу рассылку.";
    } else {
        $el = new CIBlockElement;

        if (!empty($_POST['name'])) {
            $name = trim($_POST['name']);
        } else {
            $name = 'Подписчик';
        }

        $data = array(
            'IBLOCK_ID' => 42,
            'NAME' => $name,
            'PROPERTY_VALUES' =>array(
                'EMAIL' => $_POST['email'],
            ),
        );

        if (!$id = $el->Add($data)) {
            $error =  $el->LAST_ERROR;
            $msg['status'] = 0;
            $msg['message'] = strip_tags($error);
        } else {
            $_SESSION['subscribe_email'] = trim($_POST['email']);
            global $APPLICATION;
            $APPLICATION->set_cookie("subscribe_email", trim($_POST['email']), time()+60*60*24*30*12*2);
            $msg['status'] = 1;
            $msg['message'] = 'Вы успешно подписаны на рассылку!';
        }
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
