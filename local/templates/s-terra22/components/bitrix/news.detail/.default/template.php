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
$date = strtotime($arResult['ACTIVE_FROM'])
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
    <div class="container">
        <div class="row pressnews-item-page">
            <div class="col col-12 col-sm-12 col-md-8">
                <div class="pressnews-item-page__header">
                    <div class="pressnews-item-page__title"><?=$arResult['NAME']?></div>
                    <div class="pressnews-item-page__block">
                        <div class="pressnews-item-page__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                        <div class="pressnews-item-page__category"><?=$arResult['IBLOCK_ID'] == 36 ? 'объявление' : 'новость'?></div>
                    </div>
                </div>
                <div class="pressnews-item-page__text-block__content">
                    <?
                    echo $arResult['DETAIL_TEXT'];
                    ?>
                    <?if(count($arResult['PROPERTIES']['IMAGES']['VALUE'])):?>
                    <div class="scroll-slider">
                        <div class="pressnews-item-page__images-slider__top my-gallery" id="pressnews-item-page__images-slider__top">
                            <?foreach ($arResult['PROPERTIES']['IMAGES']['VALUE'] as $img):?>
                            <div class="slider-item">
                                <figure><img src="<?=CFile::GetPath($img)?>" alt=""></figure>
                            </div>
                            <?endforeach;?>
                        </div>
                        <div class="pressnews-item-page__images-slider__bottom">
                            <ul id="pressnews-item-page__images-slider__bottom">
                                <?foreach ($arResult['PROPERTIES']['IMAGES']['VALUE'] as $img):
                                    $resizedIMG = CFile::ResizeImageGet(CFile::GetFileArray($img), Array('width' => 120, 'height' => 80));
                                    ?>
                                <li><img src="<?=$resizedIMG['src']?>" alt=""></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <?endif?>
                    <?
                    if ($arResult['PROPERTIES']['TEXT_UNDER_SLIDER']['~VALUE']['TEXT']) echo $arResult['PROPERTIES']['TEXT_UNDER_SLIDER']['~VALUE']['TEXT'];
                    //else echo $arResult['PREVIEW_TEXT'];
                    ?>


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
                        <?if($arResult['IBLOCK_ID'] != 36):?>
                        <a class="btn btn-primary-inverse" href="/press/news/">Все новости</a>
                        <?else:?>
                            <a class="btn btn-primary-inverse" href="/press/ads/">Все объявления</a>
                        <?endif?>
                    </div>
                </div>
            </div>

            <?if($arResult['IBLOCK_ID'] == 36):?>
            <div class="col col-12">
                <div class="pressnews-page__contacts">
                    <div class="pressnews-page__contacts__title">Контакты отдела продаж</div>
                    <?
                    $APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/phone.php"
                    	)
                    );

                    $APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/local/include/email.php"
                    	)
                    );
                    ?>
                </div>
            </div>
            <?endif?>


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
