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
        <div class="support-documentation-tab-2 form-js" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->NavPageSize?>" data-action="/local/ajax/licences.php" data-method="GET">
            <div class="support-documentation-tab-2__top">
				<a href="/lic.zip" class="btn btn-primary-inverse">
                <svg class="btn-icon">
					<use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                </svg>
                <span>Скачать все лицензии</span></a>
            </div>
            <div class="support-documentation-tab-2__content js-body">
			<? foreach($arResult['ITEMS'] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
			?>
              <div class="support-documentation-tab-2__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="support-documentation-tab-2__item__wrap">
					<div class="support-documentation-tab-2__item__close">
                          <svg width="20" height="20">
                            <use xlink:href="#i-close-custom" href="#i-close-custom"></use>
                          </svg>
                  </div>
                <div class="support-documentation-tab-2__item__image my-gallery">
                    <figure>
                        <a class="big-img" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                        </a>
                    </figure>
                 <!--   <img src="<?/*=$arItem["PREVIEW_PICTURE"]["SRC"]*/?>">-->
                </div>
                <div class="support-documentation-tab-2__item__text">
                  <div class="support-documentation-tab-2__item__text__title"><?=$arItem["NAME"]?></div>
                    <div class="support-documentation-tab-2__item__text__subtitle"><?=$arItem["PROPERTIES"]["DATE_FROM"]["VALUE"]?> — <?=$arItem["PROPERTIES"]["DATE_TO"]["VALUE"] ? $arItem["PROPERTIES"]["DATE_TO"]["VALUE"] : 'Бессрочно'?></div>
                    <div class="support-documentation-tab-2__item__text__description"><?=$arItem["PREVIEW_TEXT"]?></div>
					<div class="support-documentation-tab-2__item__text__extra">Весь текст</div>
					<a target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE_FOR_SAVE"]["VALUE"]);?>" class="btn btn-primary-inverse">
                    <svg class="btn-icon desktop">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span>
                  </a>
                  </div>
              </div>
            </div>

	<?endforeach?>
            </div>
            <div class="vacancies-vacant__controll js-control-text-support-documentation-2-show">
                <div class="vacancies-vacant__controll__text js-control-text js-control-text-support-documentation-2"></div>
                <button class="js-control-more js-control-more-support-documentation-2 vacancies-vacant__controll__btn btn btn-primary-inverse active"></button>
            </div>
