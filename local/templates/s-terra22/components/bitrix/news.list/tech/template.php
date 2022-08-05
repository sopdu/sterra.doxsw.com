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
$this->setFrameMode(true);                 //    echo "<pre>"; print_r($arResult); echo "</pre>";
?>

<div class="tab-body__item" data-type="tech">
    <div class="our-partners__grid">
        <?foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
            ?>
            <a class="our-partners-item"  target="_blank" href="<?=$arItem["PROPERTIES"]["SSYLKA"]["VALUE"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
            </a>
        <?endforeach;?>
    </div>
    <div class="vacancies-vacant__controll js-control-text-partner-show">
        <div class="vacancies-vacant__controll__text js-control-text-partner"></div>
        <button class="js-control-more-partner js-control-more vacancies-vacant__controll__btn btn btn-primary-inverse"></button>
    </div>
</div>


                