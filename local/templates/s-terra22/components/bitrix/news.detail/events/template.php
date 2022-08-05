<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
$ruMonths = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
];


$dateFrom = strtotime($arResult['PROPERTIES']['FROM']['VALUE']);
$dateTo = strtotime($arResult['PROPERTIES']['TO']['VALUE']);
$dateText = '';

if ($dateFrom){
    $dateText = date('d', $dateFrom).' '.$ruMonths[date('n', $dateFrom)-1];
    if (date('Y', $dateFrom) != date('Y', $dateTo)) $dateText.=' '.date('Y', $dateFrom);
    if ($dateTo) $dateText .= ' - '. date('d', $dateTo).' '.$ruMonths[date('n', $dateTo)-1].' '.date('Y', $dateTo);
}

if (!$arResult['PROPERTIES']['PLACE']['VALUE'] || $arResult['PROPERTIES']['PLACE']['VALUE'] == 'Он-лайн' || $arResult['PROPERTIES']['PLACE']['VALUE'] == 'Онлайн'){
    $icon = 'pc';
    $place = 'Онлайн';
} else{
    $icon = 'map';
    $place = $arResult['PROPERTIES']['PLACE']['VALUE'];
}

?>

<svg style="display: none;" class="symbols">
    <symbol id="i-map" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" fill="none">
        <path d="M15.5 8C15.5 3.85786 12.1421 0.5 8 0.5C3.85786 0.5 0.5 3.85786 0.5 8C0.5 9.48045 0.928944 10.8607 1.66933 12.0233C3.24663 14.5 8 18.5 8 18.5C8 18.5 12.7534 14.5 14.3307 12.0233C15.0711 10.8607 15.5 9.48045 15.5 8Z" stroke="#7470E0"/>
        <circle cx="8" cy="8" r="3.5" stroke="#7470E0"/>
    </symbol>

    <symbol id="i-pc" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 17 17" fill="none">
        <path d="M0.5 1.5C0.5 0.947715 0.947715 0.5 1.5 0.5H15.5C16.0523 0.5 16.5 0.947715 16.5 1.5V10.5C16.5 11.0523 16.0523 11.5 15.5 11.5H1.5C0.947715 11.5 0.5 11.0523 0.5 10.5V1.5Z" stroke="#7470E0"/>
        <path d="M4.5 15.5C4.5 14.9477 4.94772 14.5 5.5 14.5H11.5C12.0523 14.5 12.5 14.9477 12.5 15.5C12.5 16.0523 12.0523 16.5 11.5 16.5H5.5C4.94772 16.5 4.5 16.0523 4.5 15.5Z" stroke="#7470E0"/>
        <path d="M6.5 11.5H10.5V14.5H6.5V11.5Z" stroke="#7470E0"/>
    </symbol>
</svg>

<div class="press-news-item">
    <main class="page-main"></main>
    <?$APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        ".default",
        Array(
            "START_FROM" => "1",
            "PATH" => "",
            "SITE_ID" => SITE_ID,
        ),
        false
    );?>
    <div class="container">
        <div class="row pressnews-item-page">
            <div class="col col-12 col-sm-12 col-md-8">
                <div class="pressnews-item-page__header">
                    <div class="pressnews-item-page__title"><?=$arResult['NAME']?></div>
                    <div class="pressnews-item-page__block">
                        <div class="pressnews-item-page__date"><?=$dateText?></div>
                        <div class="pressnews-item-page__category">мероприятие</div>
                    </div>
                </div>
                <div class="pressnews-item-page__text-block__content">
                    <?if ($arResult['DETAIL_PICTURE']['SRC']):?>
                    <div class="pressevent-item-page__preview"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"></div>
                    <?elseif($arResult['PREVIEW_PICTURE']['SRC']):?>
                        <div class="pressevent-item-page__preview"><img src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>"></div>
                    <?endif;?>
                    <div class="pressevent-item-page__locale">
                        <svg width="10" height="10">
                            <use xlink:href="#i-<?=$icon?>" href="#i-<?=$icon?>"></use>
                        </svg>
                        <div class="pressevent-page__item__text"><?=$place?></div>
                    </div>
                    <?=$arResult['DETAIL_TEXT']?>
                    <div class="pressnews-item-page__text-block__btn-group">
                        <?$rs=CIBlockElement::GetList(array("PROPERTY_FROM" => "asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]), false, array("nElementID"=>$arResult["ID"], "nPageSize"=>1), array("ID", "DETAIL_PAGE_URL"));
                        while($ar=$rs->GetNext()) {
                            $page[] = $ar;
                        }
                        ?>

                        <?if (count($page) == 2 && $arResult["ID"] == $page[0]['ID']):?>
                            <a class="btn btn-primary-inverse btn-round" href="<?=$page[1]['DETAIL_PAGE_URL']?>">
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                                </svg>
                            </a>
                            <a class="btn btn-primary-inverse btn-round" href="#" disabled="">
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                                </svg>
                            </a>

                        <?elseif (count($page) == 3):?>
                            <a class="btn btn-primary-inverse btn-round" href="<?=$page[2]['DETAIL_PAGE_URL']?>">
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                                </svg>
                            </a>

                            <a class="btn btn-primary-inverse btn-round" href="<?=$page[0]['DETAIL_PAGE_URL']?>">
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                                </svg>
                            </a>

                        <?elseif (count($page) == 2 && $arResult["ID"] == $page[1]['ID']):?>
                            <a class="btn btn-primary-inverse btn-round" href="#" disabled>
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                                </svg>
                            </a>

                            <a class="btn btn-primary-inverse btn-round" href="<?=$page[0]['DETAIL_PAGE_URL']?>">
                                <svg width="7" height="12">
                                    <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                                </svg>
                            </a>
                        <?endif;?>

                        <a class="btn btn-primary-inverse" href="/press/exhibitions_and_conferences/">Все мероприятия</a>
                    </div>
                </div>
            </div>
            <div class="pressnews-item-page__form">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/include/contact-form.php"
                    )
                );
                ?>
            </div>

        </div>
    </div>
</div>
