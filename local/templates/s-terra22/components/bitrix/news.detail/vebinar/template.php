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
$date = strtotime($arResult['ACTIVE_FROM']);
$this->addExternalJS('/local/templates/s-terra22/plugins/plyr/plyr.js');
$this->addExternalCSS('/local/templates/s-terra22/plugins/plyr/plyr.css');
?>
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

    <svg style="display:none;">
        <symbol id="i-play" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 18" fill="none">
            <path xmlns="http://www.w3.org/2000/svg" d="M87.1369 9.86158C86.6564 7.92761 85.6777 6.15563 84.2998 4.72462C82.9218 3.29361 81.1934 2.25425 79.2891 1.71151C72.3313 3.64336e-07 44.5 0 44.5 0C44.5 0 16.6687 1.21445e-07 9.7109 1.87452C7.80659 2.41725 6.07818 3.45661 4.70024 4.88762C3.32231 6.31863 2.34365 8.09061 1.86313 10.0246C0.589741 17.1378 -0.0331404 24.3537 0.00231244 31.5815C-0.0430781 38.8638 0.579843 46.1347 1.86313 53.3014C2.39289 55.1753 3.39347 56.8799 4.76819 58.2505C6.14292 59.621 7.84532 60.6113 9.7109 61.1255C16.6687 63 44.5 63 44.5 63C44.5 63 72.3313 63 79.2891 61.1255C81.1934 60.5828 82.9218 59.5434 84.2998 58.1124C85.6777 56.6814 86.6564 54.9094 87.1369 52.9754C88.4005 45.9158 89.0233 38.7549 88.9977 31.5815C89.0431 24.2992 88.4202 17.0283 87.1369 9.86158Z" fill="black"/>
            <path xmlns="http://www.w3.org/2000/svg" d="M36 45L60 32L36 19V45Z" fill="white"/>
        </symbol>

        <symbol id="i-upload-item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 18" fill="none">
            <path xmlns="http://www.w3.org/2000/svg" d="M8.5 0.999512V12.9995M8.5 12.9995L13.375 8.12451M8.5 12.9995L3.625 8.12451M1 15.2495H16" stroke="#1E1D85" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
    </svg>



    <div class="container">
        <div class="row pressnews-item-page pressweb-item-page">
            <div class="col col-12 col-sm-12 col-md-8">
                <div class="pressnews-item-page__header">
                    <div class="pressnews-item-page__title"><?=$arResult['NAME']?></div>
                    <div class="pressnews-item-page__block">
                        <div class="pressnews-item-page__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                        <div class="pressnews-item-page__category">вебинар</div>
                    </div>
                </div>
                <div class="pressnews-item-page__text-block__content">
                    <?if($arResult['PROPERTIES']['YOUTUBE']['VALUE']):?>
                    <div class="video-wrap">
                        <iframe class="yt-video" width="560" height="315" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['YOUTUBE']['VALUE']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <?elseif ($arResult['PROPERTIES']['VIDEO']['VALUE']):?>
                    <div class="pressweb-item-page__preview">
                        <video id="player" playsinline controls <?=$arResult['DETAIL_PICTURE']['SRC'] ? 'data-poster="'.$arResult['DETAIL_PICTURE']['SRC'].'"' : ''?> data-poster="./img/pressweb/1.png">
                            <source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO']['VALUE'])?>" type="video/mp4">
                        </video>
                    </div>
                    <?endif;?>
                    <div class="row team">
                        <div class="col col-12 col-sm-7 col-md-7">
                            <?
                            if (count($arResult['PROPERTIES']['STAFF']['VALUE'])):
                            $staffDB = CIBlockElement::GetList(
                                Array('SORT' => 'ASC'),
                                Array('IBLOCK_ID' => 53, 'ID' => $arResult['PROPERTIES']['STAFF']['VALUE'])
                            );
                            while ($staffItem = $staffDB->Fetch()):
                                if($staffItem['PREVIEW_PICTURE']) $src = CFile::GetPath($staffItem['PREVIEW_PICTURE']);
                                else $src = SITE_TEMPLATE_PATH.'/images/team/1.png';
                            ?>
                            <div class="pressweb-item-page__team"><img src="<?=$src?>">
                                <div class="pressweb-item-page__team__text"> <strong><?=$staffItem['NAME']?>, </strong><span>инженер отдела технического консалтинга ООО «С-Терра СиЭсПи»</span></div>
                            </div>
                            <?endwhile;?>
                            <?endif;?>
                        </div>
                        <div class="col col-12 col-sm-5 col-md-5">
                            <?if ($arResult['PROPERTIES']['PDF']['VALUE']):?>
                            <a target="_blank" href="<?=CFile::GetPath($arResult['PROPERTIES']['PDF']['VALUE'])?>" class="btn btn-primary-inverse btn-lg m-b">
                                <div class="btn-icon">
                                    <svg width="22" height="18">
                                        <use xlink:href="#i-upload-item" href="#i-upload-item"></use>
                                    </svg>Скачать презентацию PDF
                                </div>
                            </a>
                            <?endif;?>
                        </div>
                    </div>
                    <?=$arResult['DETAIL_TEXT']?>
                    <div class="pressnews-item-page__text-block__btn-group">
                        <?$rs=CIBlockElement::GetList(array("active_from" => "asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]), false, array("nElementID"=>$arResult["ID"], "nPageSize"=>1), array("ID", "DETAIL_PAGE_URL"));
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

                        <a class="btn btn-primary-inverse" href="/press/webinars/">Все вебинары</a>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-sm-12 col-md-4 sidebar">
                <div class="col col-12 pressweb-item-page__item__title">Другие вебинары</div>
                <div class="row">
                    <?
                    $itemsDB = CIBlockElement::GetList(
                        Array('ACTIVE_FROM' => 'DESC'),
                        Array('!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID']),
                        false,
                        Array('nPageSize' => 3)
                    );
                    while ($arItem = $itemsDB->Fetch()):
                        $date = strtotime($arItem['ACTIVE_FROM']);?>
                    <div class="col col-12 col-sm-6 col-md-12">
                        <a class="pressnews-page__item" href="/press/webinars/<?=$arItem['CODE']?>">
                            <?if ($arItem['PREVIEW_PICTURE']) $src = CFile::GetPath($arItem['PREVIEW_PICTURE']);
                            else $src = SITE_TEMPLATE_PATH.'/images/pressnews/no-img.svg'?>
                            <div class="pressnews-page__item__image" style="background-image: url('<?=$src?>');"></div>
                            <div class="pressnews-page__item__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                            <div class="pressnews-page__item__title"><?=$arItem['NAME']?></div>
                        </a>
                    </div>
                    <?endwhile;?>
                </div>
                <a class="btn btn-primary-inverse btn-round" href="/press/webinars/">Все вебинары</a>
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
