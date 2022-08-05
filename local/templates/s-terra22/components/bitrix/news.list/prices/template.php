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
$this->setFrameMode(true);   //   echo "<pre>"; print_r($arResult); echo "</pre>";

use Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc;

?>
<? if(count($arResult["ITEMS"])): ?>
    <div class="price-slider">
        <div class="container">
            <div class="price-slider__wrap">
                <div class="price-slider-slider js-price-slider-1">
                    <?foreach($arResult["ITEMS"] as $arItem):
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                        <div class="price-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="price-slider__item__wrap">
                                <div class="price-slider__item__title"><?=$arItem["NAME"]?></div>
                                <div class="price-slider__item__title-lite"><?=$arItem["PREVIEW_TEXT"]?></div>
                                <label class="checkbox">
                                    <input type="checkbox" name="agreement"><span class="checkbox-box"></span>
                                    <div class="checkbox-label">Я ознакомлен(а) с информацией, что прайс <a href="/info-warning.php">не является офертой</a></div>
                                </label><a class="btn btn-primary-inverse disabled" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"])?>" download>
                                    <svg class="btn-icon" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 0.999512V12.9995M8.5 12.9995L13.375 8.12451M8.5 12.9995L3.625 8.12451M1 15.2495H16" stroke="#1E1D85" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="btn-icon btn-icon-mobile"width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 0.999512V12.9995M8.5 12.9995L13.375 8.12451M8.5 12.9995L3.625 8.12451M1 15.2495H16" stroke="#1E1D85" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg><span>Скачать</span></a>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="price-slider__control js-price-slider-control-1">
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
    </div>

<? endif; ?>