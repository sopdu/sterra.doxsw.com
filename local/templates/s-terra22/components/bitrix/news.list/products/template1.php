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



    $arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], 'IBLOCK_SECTION_ID' => $section['ID']);
    if ($depth <= 2){
        if ($section['UF_CURRENT_VERSION']) $arFilter['ID'] = $section['UF_CURRENT_VERSION'];
        $DBNewSection = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, false, $arSelect = array("CODE"));
        $newSection = $DBNewSection->Fetch();
        LocalRedirect('/catalog/products/'.$newSection['CODE']);
    } else{
        $versions = Array();
        $sectionsDB = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arResult['SECTION']['PATH'][$depth-1]['IBLOCK_SECTION_ID']), false, $arSelect = array("UF_MENU_NAME"));
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
                                                        <a href="/catalog/products/<?=$version['CODE']?>" class="select-box__option" for="<?=$key?>"
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
                                    <div class="product-card-jumbotron__text__item">
                                        <div class="product-card-jumbotron__text__item__title">????????????????????</div>
                                        <div class="product-card-jumbotron__text__item__value"><?=$sectionParent['UF_DESIGN']?></div>
                                    </div>
                                    <div class="product-card-jumbotron__text__item">
                                        <div class="product-card-jumbotron__text__item__title">???????????? ????????????????????????
                                            ????????
                                        </div>
                                        <div class="product-card-jumbotron__text__item__value"><?=$sectionParent['UF_CERT_CLASS']?></div>
                                    </div>
                                </div>
                                <div class="product-card-jumbotron__text__buttons btn-dekstop">
                                    <a href="#form" class="btn btn-accent btn-lg">???????????????? ????????????</a>
                                    <?if($section['UF_PRICE']):
                                        $plDB = CIBlockElement::GetProperty(55, $section['UF_PRICE'], array("sort" => "asc"), Array("CODE"=>"FILE"));
                                        $pl = $plDB->Fetch();
                                        if ($pl['VALUE']):
                                    ?>
                                    <a target="_blank" href="<?=CFile::GetPath($pl['VALUE'])?>" class="btn btn-lg btn-white">??????????-????????</a>
                                    <?endif;endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-jumbotron__description">
                            <?
                            $itemsDB = CIBlockElement::GetList(
                                Array('SORT' => 'ASC'),
                                Array('IBLOCK_ID' => 59, 'ID' => $sectionParent['UF_ADVANTAGES_HEADER']),
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
                            <button class="btn btn-accent btn-lg">????????????</button>
                            <button class="btn btn-lg btn-white">??????????-????????</button>
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
    <?if(count($arResult['ITEMS'])):?>
    <div class="product-card-modification">
        <div class="container">
            <div class="product-card-modification__title">??????????????????????</div>
            <div class="product-card-modification__block">
                <?foreach ($arResult['ITEMS'] as $arItem):?>
                <div class="product-card-modification__item">
                    <div class="product-card-modification__item-wrap">
                        <div class="product-card-modification__item-image"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                        <div class="product-card-modification__item-text">
                            <div class="product-card-modification__item-text__title"><?=$arItem['NAME']?></div>
                            <?if($arItem['PROPERTIES']['SUBTITLE']['VALUE']):?>
                            <div class="product-card-modification__item-text__subtitle"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']?></div>
                            <?endif;?>
                            <div class="product-card-modification__item-text__description"><?=$arItem['PREVIEW_TEXT']?></div>
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
                <?endforeach;?>
            </div>
            <div class="product-card-modification__buttons">
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
                <?if ($section['UF_DOC']):?>
                <a target="_blank" href="<?=CFile::GetPath($section['UF_DOC'])?>" class="btn btn-primary-inverse btn-dekstop">???????????????? ???????????????????????? ???? ??????????????????</a>
                <a target="_blank" href="<?=CFile::GetPath($section['UF_DOC'])?>" class="btn btn-primary-inverse btn-mobile">???????????????????????? ???? ??????????????????</a>
                <?endif?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="product-card-advantages">
        <div class="container">
            <div class="product-card-advantages__wrap">
                <div class="product-card-advantages__content">
                    <div class="product-card-advantages__content__title">???????????????????????? ???????????????? <?=$section['NAME']?>
                    </div>
                    <div class="product-card-advantages__content__items">
                        <?$counter = 1;
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
                                    ????????????????????
                                </button>
                            </div>
                        </div>
                        <?endif;?>
                    </div>
                </div>
                <div class="product-card-advantages__banner">
                    <div class="product-card-advantages__banner__image"
                         style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/product-card/advantages/pic.png)"></div>
                    <div class="product-card-advantages__banner-text">
                        <div class="product-card-advantages__banner-text__title">?????????????????????? ??????????????????</div>
                        <a class="btn btn-accent" href="/catalog/products/" download>
                            <svg class="btn-icon">
                                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#i-arrow-2"></use>
                            </svg>
                            <span>?????????????? ??????????????????</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    $certs = Array();
    $certDB = CIBlockElement::GetList(
        Array('SORT' => 'ASC'),
        Array('IBLOCK_ID' => 41, 'PROPERTY_PRODUCT' => $section['ID']),
        false,
        false,
        Array('PROPERTY_ACTIV_TO', 'NAME', 'PREVIEW_PICTURE')
    );
    while ($cert = $certDB->Fetch()) $certs[] = $cert;
    if (count($certs)):
    ?>
    <div class="product-card-sertificates">
        <div class="product-card-sertificates__wrap">
            <div class="product-card-sertificates__title">?????????????????????? <?=$section['NAME']?></div>
            <div class="product-card-sertificates-slider js-sert-slider-1">
                <?foreach ($certs as $cert):?>
                <div class="product-card-sertificates__item"><a class="product-card-sertificates__item__wrap" href="#">
                        <div class="product-card-sertificates__item-image"><img src="<?=CFile::GetPath($cert['PREVIEW_PICTURE'])?>">
                        </div>
                        <div class="product-card-sertificates__item-content">
                            <div class="product-card-sertificates__item__title"><?=$cert['NAME']?></div>
                            <div class="product-card-sertificates__item__description">
                                <?if ($cert['PROPERTY_ACTIV_TO_VALUE']):?>
                                <ul>
                                    <li>???????????????????????? ???? <?=date('d.m.Y', strtotime($cert['PROPERTY_ACTIV_TO_VALUE']))?></li>
                                </ul>
                                <?endif?>
                            </div>
                        </div>
                    </a></div>
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
                <a class="btn btn-primary-inverse btn-mobile" href="#">?????? ??????????????????????</a>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="product-card-tabs">
        <div class="container">
            <div class="product-card-tabs__wrap tab">
                <ul class="product-card-tabs__head tab-head">
                    <?if(count($section['UF_CHARACTERISTICKS'])):?>
                    <li class="product-card-tabs__head-item tab-head__item" data-type="1">
                        <div class="tab-head__button active">????????????????????????????</div>
                    </li>
                    <?endif?>
                    <?if(count($section['UF_TECH'])):?>
                    <li class="product-card-tabs__head-item tab-head__item" data-type="2">
                        <div class="tab-head__button">????????????????????</div>
                    </li>
                    <?endif?>
                    <li class="product-card-tabs__head-item tab-head__item" data-type="3">
                        <div class="tab-head__button">????????????????????????</div>
                    </li>
                </ul>
                <div class="tab-body">
                    <?if(count($section['UF_CHARACTERISTICKS'])):?>

                    <div class="tab-body__item" data-type="1">
                        <div class="accordion tabs-accordion">
                            <?
                            $itemsDB = CIBlockElement::GetList(
                                Array('SORT' => 'ASC'),
                                Array('IBLOCK_ID' => 57, 'ID' => $section['UF_CHARACTERISTICKS']),
                                false,
                                false,
                                Array('NAME', 'PREVIEW_TEXT')
                            );

                            while ($item = $itemsDB->Fetch()):
                            ?>
                            <section class="home-faq-item accordion-item">
                                <header class="home-faq-item__header accordion-item-header accordion-trigger">
                                    <h2 class="home-faq-item__title"><?=$item['NAME']?></h2>
                                    <div class="home-faq-item__state"></div>
                                </header>
                                <div class="accordion-item-panel">
                                    <div class="home-faq-item__content"><?=$item['PREVIEW_TEXT']?></div>
                                </div>
                            </section>
                            <?endwhile;?>
                        </div>
                    </div>
                    <?endif?>
                    <?if(count($section['UF_TECH'])):?>
                    <div class="tab-body__item" data-type="2">
                        <div class="technology-list">
                            <?
                            $itemsDB = CIBlockElement::GetList(
                                Array('SORT' => 'ASC'),
                                Array('IBLOCK_ID' => 58, 'ID' => $section['UF_TECH']),
                                false,
                                false,
                                Array('NAME', 'PREVIEW_TEXT')
                            );

                            while ($item = $itemsDB->Fetch()):
                            ?>
                            <div class="technology-list__item">
                                <div class="technology-list__item__title"><?=$item['NAME']?></div>
                                <div class="technology-list__item__value"><?=$item['PREVIEW_TEXT']?></div>
                            </div>
                            <?endwhile;?>
                        </div>
                    </div>
                    <?endif;?>
                    <?if($section['DESCRIPTION']):?>
                    <div class="tab-body__item" data-type="3">
                        <div class="exploitation">
                            <?= $section['DESCRIPTION']?>
                            <!--<h3>????????????????????</h3>
                            <ul>
                                <li>
                                    <p><b>?????????????????????????????? ????????????????</b></p>
                                    <p>?????????????? ?????????????????????????????????? ???????????????????? ??-?????????? ????</p>
                                </li>
                                <li>
                                    <p><b>????????????????</b></p>
                                    <p>???????????????? SSH ?? ?????????????? ???????????????????? ?????????????????? ???????????? ?? ??????????????????????????
                                        ???????????? Cisco IOS</p>
                                </li>
                                <li>
                                    <p><b>????????????????</b></p>
                                    <p>?????????????????? ?????????????????? ???????????? ?? ?????????????????????????? ???????????? Cisco IOS</p>
                                </li>
                            </ul>


                            <h3>??????????????????????????</h3>
                            <ul>
                                <li>
                                    <p><b>????????????:</b></p>
                                    <p>??? eToken Java 72??</p>
                                    <p>??? JaCarta PKI, JaCarta PKI/????????</p>
                                    <p>??? ?????????????? Lite, ?????????????? ??????, ?????????????? ?????? 2.0</p>
                                </li>
                                <li>
                                    <p><b>?? ?????????? ???????????????????? ???????????????????? IPsec/IKE ?? ???? ????????????????????:</b></p>
                                    <p>??? ?? Cisco IOS v.12.4 ?? v.15.x.x</p>
                                    <p>??? ?? ???????? ?????????????????? CSP 5.0</p>
                                </li>
                            </ul>

                            <h3>?????????????????????? ??????????????????</h3>
                            <p>???????????????? ???????????????? ???????????????? ???????????????? 1 (????????) ?????? ?????????????????????? ?????????????????? (????
                                ???????????????????????????????? ???? ???????????????????? ???? ?????????? ????????????). ?????????????????????? ????????????????????
                                ???????????? ?????????????? ?????????????????????? ???????????????????? ???? ?????????????????????? ???????????? ????????????????????????
                                ????????????????.</p>
                            <p>???????????????? ???????????????? ???????????????????? ?????????????????? ???????????????? 3 (??????) ???????? ???????????????? ????
                                ?????????????????????????? ???????????????????? ??????????????????. <a href="#">???????????????????? ?? ??????????????????????
                                    ???????????????????????? ????.</a></p>-->
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
                        <a target="_blank" class="product-card-tabs__banner-text__link" href="<?=$section['UF_BANNER_LINK']?>"><span>??????????????????</span>
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
    <?if($section['UF_VIDEO']):?>
    <div class="product-card-video-slider">
        <div class="product-card-video-slider__wrap">
            <div class="product-card-video-slider__title">?????????????????? ??????????</div>
            <div class="product-card-video-slider-slider js-video-slider-1">
                <?
                $itemsDB = CIBlockElement::GetList(
                    Array('SORT' => 'ASC'),
                    Array('IBLOCK_ID' => 56, 'ID' => $section['UF_VIDEO']),
                    false,
                    false,
                    Array('NAME', 'PROPERTY_YT_REF', 'PREVIEW_PICTURE')
                );

                while ($item = $itemsDB->Fetch()):
                ?>
                <div class="product-card-video-slider__item">
                    <a target="_blank" class="product-card-video-slider__item__wrap" href="<?=$item['PROPERTY_YT_REF_VALUE']?>">
                        <div class="product-card-video-slider__item-image"><img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>"></div>
                        <div class="product-card-video-slider__item__title"><?=$item['NAME']?></div>
                    </a>
                </div>
                <?endwhile;?>
            </div>
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
                <a class="btn btn-primary-inverse">?????? ????????????????????</a>
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
            <div class="product-card-items-slider__title"><?=$section['NAME']?> ?? ?????????????????????? ???????????????? ?????? ??????????????</div>
            <div class="product-card-items-slider-slider js-items-slider-1">
                <?foreach ($complex as $complexItem):?>
                <div class="product-card-items-slider__item">
                    <a class="product-card-items-slider__item__wrap" href="<?=$complexItem['DETAIL_PAGE_URL']?>">
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
    const anchors = document.querySelectorAll('.btn-accent')

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
</script>