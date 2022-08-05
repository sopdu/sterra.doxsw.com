<?php
$arItems = [];
foreach ($arResult["SEARCH"] as $arItem){
    $arItems[] = Array(
        'href' => $arItem["URL"],
        'title' => str_replace($_GET['q'], '<b>'.$_GET['q'].'</b>', $arItem["TITLE_FORMATED"]),
        'description' => str_replace($_GET['q'], '<b>'.$_GET['q'].'</b>', $arItem["BODY_FORMATED"])
    );
}
$result = Array(
  'items' => $arItems,
  'size' => $arResult['NAV_RESULT']->NavRecordCount
);
echo json_encode($result);
?>