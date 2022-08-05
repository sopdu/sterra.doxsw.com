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

<div class="partner-history">
          <div class="container">
            <div class="partner-history-title">Истории сотрудничества</div>
            <div class="partner-history-slider js-partner-slider-1">
				<?foreach ($arResult["ITEMS"] as $arItem):?>
              <div class="partner-history-slider__item"><a class="partner-history-slider__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                  <?if ($arItem["PREVIEW_PICTURE"]["SRC"]){?>
					<div class="partner-history-slider__item__image">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					</div>
						<?}else{?>
					<div class="partner-history-slider__item__image partner-history-slider__item__image__placeholder">
						<img src="/local/templates/s-terra22/images/placeholder.svg">
					</div>
					<?}?>
                  <div class="partner-history-slider__item__title"><?=$arItem["NAME"]?></div>
                  <div class="partner-history-slider__item__description"><?=$arItem["PREVIEW_TEXT"]?></div></a></div>
				<?endforeach;?>
            </div>
            <div class="partner-history-slider__control js-slider-control-1">
              <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                      </svg>
              </button>
              <button class="btn btn-primary-inverse btn-round" data-controls="next">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                      </svg>
				</button><a class="btn btn-primary-inverse" href="/partnery/cases/">Все кейсы</a>
            </div>
          </div>