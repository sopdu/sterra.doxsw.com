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
?>



<div class="support-download__wrap">
	<?foreach ($arResult["ITEMS"] as $arItem):?>
            <div class="support-download__item">
              <div class="support-download__item__title"><?=$arItem["NAME"];?></div>
                <a class="btn btn-primary-inverse support-download__btn" href="<?=CFile::GetPath($arItem["PROPERTIES"]["file"]["VALUE"]);?>" target="_blank">
                <svg class="btn-icon">
                  <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                </svg><span>Скачать PDF</span></a>
            </div>
            <?endforeach;?>
          </div>


