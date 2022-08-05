<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Loader::includeModule('iblock');

$request = Application::getInstance()->getContext()->getRequest();

$page = ((int)$request->get("page") > 0 ? $request->get("page") : 1);

$IBLOCK_ID = 22;

$arFilter = ["IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y", 'PROPERTY_file' != false];

if ($request->get("query") != "null" && $request->get("query") != "") {
    $arFilter["NAME"] = "%" . $request->get("query") . "%";
}


$arItems = [];

$listres = \CIBlockElement::GetList(
    ["sort" => "asc", "ACTIVE_FROM" => "DESC"],
    $arFilter,
    false,
    ["nPageSize" => 12, "iNumPage" => $request->get("page")],
    ["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_DATE_FROM", "PROPERTY_DATE_TO", "PROPERTY_FILE_FOR_SAVE"]
);

$count = $listres->SelectedRowsCount();

while ($arEl = $listres->GetNext()) {
    $timeText = $arEl["PROPERTY_DATE_TO_VALUE"] ? $arEl["PROPERTY_DATE_TO_VALUE"] : 'Бессрочно';
    $arClearEl['htmlContent'] = '<div class="support-documentation-tab-2__item">
				<div class="support-documentation-tab-2__item__wrap">
					<div class="support-documentation-tab-2__item__close">
                          <svg width="20" height="20">
                            <use xlink:href="#i-close-custom" href="#i-close-custom"></use>
                          </svg>
                  </div>
                <div class="support-documentation-tab-2__item__image my-gallery">
                    <figure>
                        <a class="big-img" href="'.CFile::GetPath($arEl['PREVIEW_PICTURE']).'">
                            <img src="'.CFile::GetPath($arEl['PREVIEW_PICTURE']).'">
                        </a>
                    </figure>
                </div>
                <div class="support-documentation-tab-2__item__text">
                  <div class="support-documentation-tab-2__item__text__title">'.$arEl["NAME"].'</div>
                    <div class="support-documentation-tab-2__item__text__subtitle">'.$arEl["PROPERTY_DATE_FROM_VALUE"].' — '.$timeText.'</div>
                    <div class="support-documentation-tab-2__item__text__description">'.$arEl["PREVIEW_TEXT"].'</div>
					<div class="support-documentation-tab-2__item__text__extra">Весь текст</div>
					<a target="_blank" href="'.CFile::GetPath($arEl["PROPERTY_FILE_FOR_SAVE_VALUE"]).'" class="btn btn-primary-inverse">
                    <svg class="btn-icon desktop">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span>
                  </a>
                  </div>
              </div>
            </div>';

    $arItems[] = $arClearEl;

}
$result = [
    "items" => $arItems,
    "size" => $count
];
echo json_encode($result);