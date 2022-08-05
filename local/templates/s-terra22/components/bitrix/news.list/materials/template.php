<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

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

?>
<svg style="display:none;">
    <symbol id="i-upload-item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 18" fill="none">
        <path xmlns="http://www.w3.org/2000/svg" d="M8.5 0.999512V12.9995M8.5 12.9995L13.375 8.12451M8.5 12.9995L3.625 8.12451M1 15.2495H16" stroke="#1E1D85" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </symbol>
</svg>
<div class="press-mark">
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
        <div class="pressmark-page__content" data-full-length="<?=count($arResult['ITEMS'])?>" data-page-size="<?=count($arResult['ITEMS'])?>" data-action="/local/ajax/materials.php" data-method="GET">
            <div class="pressmark-page__content__top">
                <div class="pressmark-page__title">Маркетинговые материалы</div>
                <ul class="pressmark-page__filter">
                    <li class="js-control-item pressmark-page__filter__item">
                        <button data-tab="prez" class="js-control-item-button pressmark-page__filter__button <?=!$_GET['tab'] || $_GET['tab'] == 'prez' ? 'active' : ''?>" type="button" data-type="44">Презентация</button>
                    </li>
                    <li class="js-control-item pressmark-page__filter__item">
                        <button data-tab="print" class="js-control-item-button pressmark-page__filter__button <?=$_GET['tab'] == 'print' ? 'active' : ''?>" type="button" data-type="45">Печатные материалы</button>
                    </li>
                    <li class="js-control-item pressmark-page__filter__item">
                        <button data-tab="corp" class="js-control-item-button pressmark-page__filter__button <?=$_GET['tab'] == 'corp' ? 'active' : ''?>" type="button" data-type="46">Корпоративный стиль</button>
                    </li>
                </ul>
            </div>
            <div class="pressmark-page__content__button">
                <?
                if (!$_GET['tab']) $_GET['tab'] == 'prez';
                ?>
                <a href="/materials-<?=$_GET['tab']?>.zip" class="btn btn-primary-inverse btn-lg m-b">
                    <div class="btn-icon">
                        <svg width="22" height="18">
                            <use xlink:href="#i-upload-item" href="#i-upload-item"></use>
                        </svg>
                    </div>Скачать все материалы ZIP
                </a>
            </div>
            <div class="pressmark-page__body row">
                <?foreach ($arResult['ITEMS'] as $arItem):
                    $date = strtotime($arItem['ACTIVE_FROM']);
                    $file = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
                    if (!$file) continue;
                ?>
                <div class="col col-12 col-sm-12 col-md-6">
                    <div class="pressmark-page__item" href="<?=$file?>">
                        <div class="pressmark-page__image"> <img class="pressmark-page__item__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"></div>
                        <div class="pressmark-page__content">
                            <div class="pressmark-page__item__title"><?=$arItem['NAME']?></div>
                            <div class="pressmark-page__item__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                            <a target="_blank" href="<?=$file?>" class="btn btn-primary-inverse btn-lg m-b">
                                <div class="btn-icon">
                                    <svg width="22" height="18">
                                        <use xlink:href="#i-upload-item" href="#i-upload-item"></use>
                                    </svg>
                                </div>Скачать PDF
                            </a>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
            <!--<div class="pressmark-page__controll">
                <div class="pressmark-page__controll__text js-control-text">Показано 12 из 1021</div>
                <button style="display:none;" class="js-control-more pressmark-page__controll__btn btn btn-primary-inverse">Еще 12</button>
            </div>-->
        </div>
    </div>
</div><!-- FOOTER -->
