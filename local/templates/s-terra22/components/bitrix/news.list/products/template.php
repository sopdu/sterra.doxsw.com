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

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
$depth = count($arResult['SECTION']['PATH']);





$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" =>$arResult['SECTION']['PATH'][$depth-1]['ID']), false, $arSelect = array("UF_*"));
$section = $rsResult->Fetch();


    $arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], 'SECTION_ID' => $section['ID']);
    if ($depth <= 2){
        //if ($section['UF_CURRENT_VERSION']) $arFilter['ID'] = $section['UF_CURRENT_VERSION'];
        $DBNewSection = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, false, $arSelect = array("CODE"));
        $newSection = $DBNewSection->Fetch();
        LocalRedirect('/products/catalog/'.$newSection['CODE'].'/');

    } else{
        $versions = Array();
        $sectionsDB = CIBlockSection::GetList(array("SORT" => "ASC"), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arResult['SECTION']['PATH'][$depth-1]['IBLOCK_SECTION_ID']), false, $arSelect = array("UF_MENU_NAME"));
        while ($sectionItem = $sectionsDB->Fetch()) $versions[] = $sectionItem;

        $sectionParentDB = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult['SECTION']['PATH'][$depth-2]['ID']), false, $arSelect = array("UF_*"));
        $sectionParent = $sectionParentDB->Fetch();
    }


$APPLICATION->AddChainItem($sectionParent['NAME']);
?>

<div class="product-card-page">
    <main class="product-card-jumbotron page-main">
        <div class="bg-block">
            <div class="jumbotron">
                <div class="container">
                    <div class="product-card-jumbotron__wrap">
                        <div class="product-card-jumbotron__text">
                            <?if($sectionParent['UF_IMG_DETAIL']):?>
                            <div class="product-card-jumbotron__text__icon"><img src="<?=CFile::GetPath($sectionParent['UF_IMG_DETAIL'])?>"></div>
                            <div class="product-card-jumbotron__text__icon__mobile"><img src="<?=CFile::GetPath($sectionParent['UF_IMG_DETAIL'])?>"></div>
                            <?endif?>
                            <div class="product-card-jumbotron__text__content">
                                <div class="product-card-jumbotron__text__title"><span
                                        class="product-card-jumbotron__text__title__main"><?=$sectionParent['NAME']?></span>

                                    <?if(count($versions)):?>
                                        <div class="product-card-jumbotron__text__title-select">
                                            <div class="select-box">
                                                <div class="select-box__current" tabindex="1">
                                                    <?foreach ($versions as $key => $version):?>
                                                    <div class="select-box__value">
                                                        <input <?=$version['ID'] == $section['ID'] ? 'checked' : ''?> class="select-box__input" type="radio" id="<?=$key?>" value="<?=$key+1?>"
                                                               name="<?=$section['ID']?>"/>
                                                        <p class="select-box__input-text"><?=$version['UF_MENU_NAME']?></p>
                                                    </div>
                                                    <?endforeach?>
                                                    <div class="select-box__icon">
                                                        <svg width="12" height="7">
                                                            <use xlink:href="#i-arrow" href="#i-arrow"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <ul class="select-box__list">
                                                    <?foreach ($versions as $key => $version):?>
                                                    <li>
                                                        <a href="/catalog/products/<?=$version['CODE']?>/" class="select-box__option" for="<?=$key?>"
                                                               aria-hidden="aria-hidden"><span><?=$version['UF_MENU_NAME']?></span></a>
                                                    </li>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?endif?>
                                </div>
                                <div class="product-card-jumbotron__text__description"><?=$sectionParent['UF_SHORT_DESCRIPTION']?></div>
                                <div class="product-card-jumbotron__text__items">
                                    <?
                                    if ($section['UF_DESIGN'][0]) $designs = $section['UF_DESIGN'];
                                    else $designs = $sectionParent['UF_DESIGN'];
                                    ?>
                                    <?if($designs[0]):?>
                                    <div class="product-card-jumbotron__text__item">
                                        <div class="product-card-jumbotron__text__item__title">Исполнения</div>
                                        <div class="product-card-jumbotron__text__item__value">
                                            <?
                                            $first = true;
                                            foreach ($designs as $key=> $design){
                                                if (!$first) echo ", <br>";
                                                else $first = false;
                                                echo $design;
                                            }?>
                                        </div>
                                    </div>
                                    <?endif?>

                                    <?
                                    if ($section['UF_CERT_CLASS'][0] || $section['UF_CERT_FBI'][0] || $section['UF_CERT_OTHER'][0]){
                                        $certClass = $section['UF_CERT_CLASS'];
                                        $certFBI = $section['UF_CERT_FBI'];
                                        $certOther = $section['UF_CERT_OTHER'];
                                    }
                                    else {
                                        $certClass = $sectionParent['UF_CERT_CLASS'];
                                        $certFBI = $sectionParent['UF_CERT_FBI'];
                                        $certOther = $sectionParent['UF_CERT_OTHER'];
                                    }
                                    ?>
                                    <?if ($certClass || $certFBI || $certOther):?>
                                    <div class="product-card-jumbotron__text__item">
                                        <div class="product-card-jumbotron__text__item__title">Сертификация
                                        </div>
                                        <div class="product-card-jumbotron__text__item__value">
                                            <?
                                                $val = '';
                                                if (count($certFBI)) {
                                                    $val .= 'ФСБ: ';
                                                    $first = true;
                                                    foreach ($certFBI as $cert) {
                                                        if (!$first) $val.=', ';
                                                        $val .= $cert;
                                                        if ($first) $first = false;
                                                    }
                                                    $val.='<br>';
                                                }
                                                if (count($certClass)) {
                                                    $val .= 'ФСТЭК: ';
                                                    $first = true;
                                                    foreach ($certClass as $cert) {
                                                        if (!$first) $val.=', ';
                                                        $val .= $cert;
                                                        if ($first) $first = false;
                                                    }
                                                    $val.='<br>';
                                                }
                                                if (count($certOther)) {
                                                    $first = true;
                                                    foreach ($certOther as $cert) {
                                                        if (!$first) $val.=', ';
                                                        $val .= $cert;
                                                        if ($first) $first = false;
                                                    }
                                                    $val.='<br>';
                                                }

                                            ?>
                                            <?=$val?>
                                        </div>
                                    </div>
                                    <?endif?>
                                </div>
                                <div class="product-card-jumbotron__text__buttons btn-dekstop">
                                    <a href="#form" class="btn btn-accent btn-lg anchor">Оставить заявку</a>
                                    <?
                                    $displayBtn = false;
                                    if($section['UF_PRICE']):
                                        $plDB = CIBlockElement::GetProperty(55, $section['UF_PRICE'], array("sort" => "asc"), Array("CODE"=>"FILE"));
                                        $pl = $plDB->Fetch();
                                        if ($pl['VALUE']):
                                            $displayBtn = true;
                                        endif;endif;
                                    ?>
                                    <a style="<?=$displayBtn ? '' : 'display:none'?>" target="_blank" href="<?=CFile::GetPath($pl['VALUE'])?>" class="btn btn-lg btn-white">Прайс-лист</a>

                                </div>
                            </div>
                        </div>
                        <div class="product-card-jumbotron__description">
                            <?
                            if ($section['UF_ADVANTAGES_HEADER']) $iconsIDs = $section['UF_ADVANTAGES_HEADER'];
                            else $iconsIDs = $sectionParent['UF_ADVANTAGES_HEADER'];
                            $itemsDB = CIBlockElement::GetList(
                                Array('SORT' => 'ASC'),
                                Array('IBLOCK_ID' => 59, 'ID' => $iconsIDs),
                                false,
                                false,
                                Array('NAME', 'PROPERTY_ICON', 'PREVIEW_PICTURE', 'PREVIEW_TEXT')
                            );

                            while ($item = $itemsDB->Fetch()):
                            ?>
                            <div class="product-card-jumbotron__description__item">
                                <div class="product-card-jumbotron__description__icon"><img src="<?=CFile::GetPath($item['PROPERTY_ICON_VALUE'])?>"></div>
                                <div class="product-card-jumbotron__description__text">
                                    <div class="product-card-jumbotron__description__title"><?=$item['NAME']?></div>
                                    <div class="product-card-jumbotron__description__text"><?=$item['PREVIEW_TEXT']?></div>
                                </div>
                            </div>
                            <?endwhile;?>
                        </div>
                        <div class="product-card-jumbotron__text__buttons btn-mobile">
                            <a href="#form" target="_blank" class="btn btn-accent btn-lg">Заявка</a>
                            <?if($section['UF_PRICE']):?>
                            <a href="<?=CFile::GetPath($pl['VALUE'])?>" class="btn btn-lg btn-white">Прайс-лист</a>
                            <?endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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

    <?if ($section['UF_DOC'] || ['UF_DOC_LINK'] ):
        if ($section['UF_DOC_LINK']) $link = $section['UF_DOC_LINK'];
        else $link = CFile::GetPath($section['UF_DOC']);
        ?>
        <div class="container">
            <div class="position-relative">
                <a target="_blank" href="<?=$link?>" class="btn btn-primary-inverse install-doc">Документация по установке</a>
            </div>
        </div>
    <?endif?>
    <?if($section['UF_DESC']):?>
    <div class="container product-text-wrap">
        <div class="product-text text-block"><?=$section['UF_DESC']?></div>
    </div>
    <?endif?>

    <div class="product-card-tabs">
        <div class="container">
            <div class="product-card-tabs__wrap tab">
                <ul class="product-card-tabs__head tab-head">
                    <?if(count($section['UF_CHAR_NAME']) && count($section['UF_CHAR_VALUE'])):?>
                        <li class="product-card-tabs__head-item tab-head__item" data-type="1">
                            <div class="tab-head__button">Характеристики</div>
                        </li>
                    <?endif?>
                    <?if(count($section['UF_TECH_NAME']) && count($section['UF_TECH_VALUE'])):?>
                        <li class="product-card-tabs__head-item tab-head__item" data-type="2">
                            <div class="tab-head__button">Технологии</div>
                        </li>
                    <?endif?>
                    <?if($section['UF_TAB'] && $section['UF_TAB_CONTENT']):?>
                        <li class="product-card-tabs__head-item tab-head__item" data-type="4">
                            <div class="tab-head__button"><?=$section['UF_TAB']?></div>
                        </li>
                    <?endif;?>
                    <?if($section['DESCRIPTION']):?>
                        <li class="product-card-tabs__head-item tab-head__item" data-type="3">
                            <div class="tab-head__button">Эксплуатация</div>
                        </li>
                    <?endif;?>
                </ul>
                <div class="tab-body">
                    <?if(count($section['UF_CHAR_NAME']) && count($section['UF_CHAR_VALUE'])):?>

                        <div class="tab-body__item" data-type="1">
                            <div class="accordion tabs-accordion">
                                <?
                                /*$itemsDB = CIBlockElement::GetList(
                                    Array('SORT' => 'ASC'),
                                    Array('IBLOCK_ID' => 57, 'ID' => $section['UF_CHARACTERISTICKS']),
                                    false,
                                    false,
                                    Array('NAME', 'PREVIEW_TEXT')
                                );

                                while ($item = $itemsDB->Fetch()):*/
                                foreach ($section['UF_CHAR_NAME'] as $key => $tabName):
                                    ?>
                                    <section class="home-faq-item accordion-item">
                                        <header class="home-faq-item__header accordion-item-header accordion-trigger">
                                            <h2 class="home-faq-item__title"><?=$tabName?></h2>
                                            <div class="home-faq-item__state"></div>
                                        </header>
                                        <div class="accordion-item-panel">
                                            <div class="home-faq-item__content"><?=$section['UF_CHAR_VALUE'][$key]?></div>
                                        </div>
                                    </section>
                                <?endforeach;?>
                            </div>
                        </div>
                    <?endif?>
                    <?if(count($section['UF_TECH_NAME']) && count($section['UF_TECH_VALUE'])):?>
                        <div class="tab-body__item" data-type="2">
                            <div class="technology-list">
                                <?
                                /*$itemsDB = CIBlockElement::GetList(
                                    Array('SORT' => 'ASC'),
                                    Array('IBLOCK_ID' => 58, 'ID' => $section['UF_TECH']),
                                    false,
                                    false,
                                    Array('NAME', 'PREVIEW_TEXT')
                                );

                                while ($item = $itemsDB->Fetch()):*/
                                foreach ($section['UF_TECH_NAME'] as $key => $tabName):
                                    ?>
                                    <div class="technology-list__item">
                                        <div class="technology-list__item__title"><?=$tabName?></div>
                                        <div class="technology-list__item__value"><?=$section['UF_TECH_VALUE'][$key]?></div>
                                    </div>
                                <?endforeach;?>
                            </div>
                        </div>
                    <?endif;?>

                    <?if($section['UF_TAB'] && $section['UF_TAB_CONTENT']):?>
                        <div class="tab-body__item" data-type="4">
                            <div class="text-block">
                                <?=$section['UF_TAB_CONTENT']?>
                            </div>
                        </div>
                    <?endif;?>

                    <?if($section['DESCRIPTION']):?>
                        <div class="tab-body__item" data-type="3">
                            <div class="exploitation">
                                <?= $section['DESCRIPTION']?>
                            </div>
                        </div>
                    <?endif;?>
                </div>
                <?if($section['UF_BANNER_HEADER']):?>
                    <div class="product-card-tabs__banner">
                        <div class="product-card-tabs__banner-text">
                            <div class="product-card-tabs__banner-text__title"><?=$section['UF_BANNER_HEADER']?></div>
                            <div class="product-card-tabs__banner-text__description"><?=$section['UF_BANNER_TEXT']?></div>
                            <?if ($section['UF_BANNER_LINK']):?>
                                <a target="_blank" class="product-card-tabs__banner-text__link" href="<?=$section['UF_BANNER_LINK']?>"><span>Подробнее</span>
                                    <svg width="12" height="7">
                                        <use xlink:href="#i-arrow" href="#i-arrow"></use>
                                    </svg>
                                </a>
                            <?endif?>
                        </div>
                        <?if ($section['PICTURE']):?>
                            <div class="product-card-tabs__banner__image"><img src="<?=CFile::GetPath($section['PICTURE'])?>"></div>
                        <?endif?>
                    </div>
                <?endif?>
            </div>
        </div>
    </div>

    <?if(count($arResult['ITEMS'])):?>
    <div class="product-card-modification">
        <div class="container">
            <?if (count($arResult['ITEMS'])):?>
            <div class="product-card-modification__title">Модификации</div>
            <div class="product-card-modification__block">
                <?foreach ($arResult['ITEMS'] as $arItem):?>

                <div class="product-card-modification__item">
                    <div class="modification-container">
                        <div class="product-card-modification__item-wrap">
                            <div class="support-documentation-tab-2__item__close">
                                <svg width="20" height="20">
                                    <use xlink:href="#i-close-thin" href="#i-close-thin"></use>
                                </svg>
                            </div>
                            <?
                            if ($arItem['PREVIEW_PICTURE']['SRC']) $url = $arItem['PREVIEW_PICTURE']['SRC'];
                            else $url = SITE_TEMPLATE_PATH.'/images/product-no-img.svg';

                            if ($arItem['PROPERTIES']['NO_IMG']['VALUE_XML_ID'] != 'Y'):
                                ?>
                                <div style="background-image: url('<?=$url?>');" class="product-card-modification__item-image"></div>
                            <?endif;?>
                            <div class="product-card-modification__item-text">
                                <div class="product-card-modification__item-text__title"><?=$arItem['NAME']?></div>
                                <?if($arItem['PROPERTIES']['SUBTITLE']['VALUE']):?>
                                    <div class="product-card-modification__item-text__subtitle"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']?></div>
                                <?endif;?>
                                <div class="product-card-modification__item-text__description">
                                    <div class="real-text text-block">
                                        <?=$arItem['PREVIEW_TEXT']?>
                                    </div>
                                    <div style="display: none" data-text="<?=$arItem['PREVIEW_TEXT']?>" class="support-documentation-tab-2__item__text__extra">Весь текст</div>
                                </div>
                                <?if(count($arItem['PROPERTIES']['CHARACTERISTICS']['VALUE'])):?>
                                    <div class="product-card-modification__item-text__blocks">
                                        <?foreach ($arItem['PROPERTIES']['CHARACTERISTICS']['VALUE'] as $char):?>
                                            <div class="product-card-modification__item-text__block">
                                                <div class="product-card-modification__item-text__block__title">
                                                    <?=$char['NAME']?>
                                                    <!--<svg width="14" height="14">
                                                        <use xlink:href="#i-exclamation-point"
                                                             href="#i-exclamation-point"></use>
                                                    </svg>-->
                                                </div>
                                                <div class="product-card-modification__item-text__block__value"><?=$char['VALUE']?></div>
                                            </div>
                                        <?endforeach;?>
                                    </div>
                                <?endif?>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
            <?endif?>
            <div class="product-card-modification__buttons">
                <?if (count($arResult['ITEMS'])):?>
                <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                    <svg width="7" height="12">
                        <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                    </svg>
                </button>
                <button class="btn btn-primary-inverse btn-round" data-controls="next">
                    <svg width="7" height="12">
                        <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                    </svg>
                </button>
                <?endif?>

            </div>
        </div>
    </div>
    <?endif?>
    <div class="product-card-advantages">
        <div class="container">
            <div class="product-card-advantages__wrap">
                <div class="product-card-advantages__content">
                    <div class="product-card-advantages__content__title">Преимущества продукта <?=$section['NAME']?>
                    </div>
                    <div class="product-card-advantages__content__items">
                        <?$counter = 1;
                        if(count($section['UF_ADVANTAGES'])):
                            $advantage = current($section['UF_ADVANTAGES']);
                            ?>
                            <div class="product-card-advantages__content__item">
                                <div class="product-card-advantages__content__item__number"><?=$counter?>.</div>
                                <div class="product-card-advantages__content__item__text"><?=$advantage?></div>
                            </div>
                        <?endif?>
                        <?
                        $counter++;
                        while($advantage = next($section['UF_ADVANTAGES'])):?>
                        <div class="product-card-advantages__content__item">
                            <div class="product-card-advantages__content__item__number"><?=$counter?>.</div>
                            <div class="product-card-advantages__content__item__text"><?=$advantage?></div>
                        </div>
                        <?
                        $counter++;
                        if ($counter >= 8) break;
                        ?>
                        <?endwhile?>
                        <?if ($section['UF_ADVANTAGES'][7]):?>
                        <div class="accordion accordion-advantages">
                            <div class="accordion-item">
                                <div class="accordion-item-panel">
                                    <?while($advantage = next($section['UF_ADVANTAGES'])):?>
                                    <div class="product-card-advantages__content__item">
                                        <div class="product-card-advantages__content__item__number"><?=$counter?>.</div>
                                        <div class="product-card-advantages__content__item__text"><?=$advantage?></div>
                                    </div>
                                    <?$counter++;
                                    endwhile;?>
                                </div>
                                <button class="btn btn-primary-inverse product-card-advantages__content__btn accordion-trigger">
                                    Развернуть
                                </button>
                            </div>
                        </div>
                        <?endif;?>
                    </div>
                </div>
                <?
                $fileItemDB = CIBlockElement::GetList(
                    Array('SORT' => 'ASC'),
                    Array('IBLOCK_ID' => 67),
                    false,
                    false,
                    Array('PROPERTY_FILE')
                );
                $fileItem = $fileItemDB->Fetch();
                $url = '';
                if ($fileItem['PROPERTY_FILE_VALUE']) $url = CFile::GetPath($fileItem['PROPERTY_FILE_VALUE']);
                ?>
                <div class="product-card-advantages__banner">
                    <div class="product-card-advantages__banner__image"
                         style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/product-card/advantages/pic.png)"></div>
                    <div class="product-card-advantages__banner-text">
                        <div class="product-card-advantages__banner-text__title">Презентация продукции</div>

                        <a class="btn btn-accent" href="<?=$url?>" download>
                            <svg class="btn-icon">
                                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#i-arrow-2"></use>
                            </svg>
                            <span>Каталог продукции</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    $certs = Array();
    $certDB = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        //array('IBLOCK_ID' => 41, 'ID' => $section['UF_CERT']),
        array('IBLOCK_ID' => 41, 'PROPERTY_PRODUCT' => $section['ID'], 'ACTIVE' => 'Y'),
        false,
        false,
        Array('PROPERTY_ACTIV_TO', 'PROPERTY_file', 'PROPERTY_ACTIV_FROM', 'PROPERTY_CRIPTOGRAFY', 'NAME', 'PREVIEW_PICTURE')
    );



    while ($cert = $certDB->Fetch()) $certs[] = $cert;
    if (count($certs)):
    ?>
    <div class="product-card-sertificates">
        <div class="product-card-sertificates__wrap">
            <div class="product-card-sertificates__title">Сертификаты <?=$section['NAME']?></div>
            <div class="product-card-sertificates-slider js-sert-slider-1">
                <?foreach ($certs as $cert):?>
                <?
                $crypto = Array($cert['PROPERTY_CRIPTOGRAFY_VALUE']);
                $valCount = 2;
                while (isset($cert['PROPERTY_CRIPTOGRAFY_VALUE_'.$valCount])){
                    $valCount++;
                    $crypto[] = $cert['PROPERTY_CRIPTOGRAFY_VALUE_'.$valCount];
                }
                if ($cert['PROPERTY_FILE_VALUE']) $link = CFile::GetPath($cert['PROPERTY_FILE_VALUE']);
                else $link = CFile::GetPath($cert['PREVIEW_PICTURE']);
                ?>
                <div class="product-card-sertificates__item">
                    <a class="product-card-sertificates__item__wrap" href="<?=$link?>" target="_blank">
                        <div class="product-card-sertificates__item-image"><img src="<?=CFile::GetPath($cert['PREVIEW_PICTURE'])?>">
                        </div>
                        <div class="product-card-sertificates__item-content">
                            <div class="product-card-sertificates__item__title"><?=$cert['NAME']?></div>
                            <div class="product-card-sertificates__item__description">
                                <?if ($cert['PROPERTY_ACTIV_TO_VALUE']):?>
                                <ul>
                                    <li>На <b><?=$section['NAME']?></b></li>
                                    <li>От <?=(explode(" ", $cert["PROPERTY_ACTIV_FROM_VALUE"])[0])?></li>
                                    <?if ($cert["PROPERTY_CRIPTOGRAFY_VALUE"]):?>
                                        <li>Криптография: <?=(implode(", ", $crypto))?></li>
                                    <?endif?>
                                    <li>Действителен до <?=date('d.m.Y', strtotime($cert['PROPERTY_ACTIV_TO_VALUE']))?></li>
                                </ul>
                                <?endif?>
                            </div>
                        </div>
                    </a>
                </div>
                <?endforeach;?>
            </div>
            <div class="product-card-sertificates-slider__control js-slider-control-1">
                <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                    <svg width="7" height="12">
                        <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                    </svg>
                </button>
                <button class="btn btn-primary-inverse btn-round" data-controls="next">
                    <svg width="7" height="12">
                        <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                    </svg>
                </button>
                <a class="btn btn-primary-inverse" href="/support/documentation/certificates/">Все сертификаты</a>
            </div>
        </div>
    </div>
    <?endif?>


    <?
    $complex = Array();
    $itemsDB = CIBlockElement::GetList(
        Array('SORT' => 'ASC'),
        Array('IBLOCK_ID' => 18, 'PROPERTY_PRODUCTS' => $sectionParent['ID']),
        false,
        false,
        Array('NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL')
    );

    while ($item = $itemsDB->Fetch()) $complex[] = $item;

    ?>
    <?if(count($complex)):?>
        <div class="product-card-items-slider">
            <div class="product-card-items-slider__wrap">
                <div class="product-card-items-slider__title"><?=$section['NAME']?> в комплексных решениях для бизнеса</div>
                <div class="product-card-items-slider-slider js-items-slider-1">
                    <?foreach ($complex as $complexItem):?>
                        <div class="product-card-items-slider__item">
                            <a class="product-card-items-slider__item__wrap" href="/catalog/complex_solutions/<?=$complexItem['CODE'].'/'?>">
                                <div class="product-card-items-slider__item__title"><?=$complexItem['NAME']?></div>
                                <div class="product-card-items-slider__item__description"><?=$complexItem['PREVIEW_TEXT']?></div>
                                <div class="product-card-items-slider__item__icon">
                                    <img src="<?=CFile::GetPath($complexItem['PREVIEW_PICTURE'])?>">
                                </div>
                            </a>
                        </div>
                    <?endforeach;?>

                </div>
                <div class="product-card-items-slider__control js-items-slider-control-1">
                    <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                        </svg>
                    </button>
                    <button class="btn btn-primary-inverse btn-round" data-controls="next">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?endif?>

    <div style="<?$section['UF_VIDEO'] ? '' : 'display:none'?>" class="product-card-video-slider">
        <div class="product-card-video-slider__wrap">
            <div class="product-card-video-slider__title">Обучающее видео</div>
            <div class="product-card-video-slider-slider js-video-slider-1">
                <?
                $itemsDB = CIBlockElement::GetList(
                    Array('SORT' => 'ASC'),
                    Array('IBLOCK_ID' => 56, 'ID' => $section['UF_VIDEO']),
                    false,
                    false,
                    Array('NAME', 'PROPERTY_YT_REF', 'PREVIEW_PICTURE', 'CODE')
                );

                while ($item = $itemsDB->Fetch()):
                ?>
                <div class="product-card-video-slider__item">
                    <a target="_blank" class="product-card-video-slider__item__wrap" href="/support/education/videouroki/<?=$item['CODE']?>/">
                        <div class="product-card-video-slider__item-image"><img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>"></div>
                        <div class="product-card-video-slider__item__title"><?=$item['NAME']?></div>
                    </a>
                </div>
                <?endwhile;?>
            </div>

            <div class="control-wrap">
                <div class="product-card-video-slider-slider__control js-video-slider-control-1">
                    <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                        </svg>
                    </button>
                    <button class="btn btn-primary-inverse btn-round" data-controls="next">
                        <svg width="7" height="12">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </button>
                </div>
                <a href="/support/education/videouroki/" class="btn btn-primary-inverse">Все видеоуроки</a>
            </div>
        </div>
    </div>



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

<script>
    const anchors = document.querySelectorAll('.anchor')

    for (let anchor of anchors) {
        anchor.addEventListener('click', function (e) {
            e.preventDefault()

            const blockID = anchor.getAttribute('href')

            document.querySelector(blockID).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            })
        })
    }

    if (window.innerWidth > 567) {
        var clampItem = document.querySelector('.product-card-jumbotron__text__description');
        $clamp(clampItem, {clamp: 5});
    }



    function overflow(e) {
        return e.scrollWidth > e.offsetWidth || e.scrollHeight > e.offsetHeight;
    }
    document.addEventListener("DOMContentLoaded", function(event) {
        var clampItems = document.querySelectorAll('.real-text');
        for (var i = 0; i<clampItems.length; i++){
            $clamp(clampItems[i], {clamp: 2, useNativeClamp: true});
        }

        setTimeout(function () {
            for (var i = 0; i<clampItems.length; i++) {
                var morebtn = clampItems[i].nextElementSibling;

                if (!overflow(clampItems[i])){
                    clampItems[i].innerHTML = morebtn.getAttribute('data-text');
                } else {
                    morebtn.style.display = 'block';
                    morebtn.addEventListener('click', function () {
                        var text = this.previousElementSibling;
                        text.style.webkitLineClamp = 'inherit';
                        text.style.textOverflow = 'inherit';
                        text.innerHTML = this.getAttribute('data-text');
                        this.style.display = 'none'
                    })
                }


                /*if (clampItems[i].innerHTML.replace(/[^a-zA-Z0-9а-яА-Я…]/g, "") != morebtn.getAttribute('data-text').replace(/[^a-zA-Z0-9а-яА-Я…]/g, "")){
                    if (clampItems[i].innerHTML.replace(/[^a-zA-Z0-9а-яА-Я]/g, "") == morebtn.getAttribute('data-text').replace(/[^a-zA-Z0-9а-яА-Я]/g, "")){
                        clampItems[i].innerHTML = morebtn.getAttribute('data-text');
                    } else {
                        morebtn.style.display = 'block';
                        morebtn.addEventListener('click', function () {
                            var text = this.previousElementSibling;
                            text.style.webkitLineClamp = 'inherit';
                            text.style.textOverflow = 'inherit';
                            text.innerHTML = this.getAttribute('data-text');
                            this.style.display = 'none'
                        })
                    }
                }*/
            }
        }, 5000)
    });





    var items = document.querySelectorAll('.product-card-modification__item-wrap');
    items.forEach(function (item) {
        var extraButton = item.querySelector('.support-documentation-tab-2__item__text__extra');
        var closeButton = item.querySelector('.support-documentation-tab-2__item__close');
        extraButton && extraButton.addEventListener('click', function () {
            items.forEach(function (item) {
                return item.classList.remove('open');
            });
            item.classList.add('open');
        });
        closeButton && closeButton.addEventListener('click', function () {
            item.classList.remove('open');
            var clampItem = item.querySelector('.real-text');
            $clamp(clampItem, {clamp: 2});
            extraButton.style.display = 'block';
        });
    });

</script>


