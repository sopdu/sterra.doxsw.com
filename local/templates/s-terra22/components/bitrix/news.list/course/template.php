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

			<div class="support-education-page__course-content">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

            ?>
				<div class="support-education-page__course__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?//if ($arItem['PREVIEW_PICTURE']['SRC']):?>
					 <a href="<?=$arItem['DETAIL_PAGE_URL']?>" style="<?=$arItem['PREVIEW_PICTURE']['SRC'] ? '' : 'background-image: url(\'/local/templates/s-terra22/images/course-no-img.svg\')'?>" class="support-education-page__course__item-image">
                     <?if ($arItem['PREVIEW_PICTURE']['SRC']):?>
                        <img class="pressnews-page__item__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                     <?endif;?>
					</a>
					<?//endif;?>
					 <div class="support-education-page__course__item-text">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="support-education-page__course__item-text__title"><?=$arItem["~NAME"]?></a>
                     <div class="support-education-page__course__item-text__block">
                  <div class="support-education-page__course__item-text__block__title">Место</div>
                  <div class="support-education-page__course__item-text__block__value"><?echo htmlspecialchars_decode($arItem["PROPERTIES"]["site"]["VALUE"])?></div>
                </div>
				 <div class="support-education-page__course__item-text__block">
                  <div class="support-education-page__course__item-text__block__title">Длительность</div>
                  <div class="support-education-page__course__item-text__block__value"><?=$arItem["PROPERTIES"]["dlitelnost"]["VALUE"]?></div>
                </div>
						 <div class="support-education-page__course__item-text__description"><?=$arItem["PREVIEW_TEXT"]?></div>
              </div></div>
        <?endforeach;?>
    </div>
