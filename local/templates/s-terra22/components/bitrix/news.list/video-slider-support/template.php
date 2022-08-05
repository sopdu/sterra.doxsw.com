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

<? if( count($arResult["ITEMS"]) ) : ?>
	<div class="support-main-video-slider-slider js-video-slider-1">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="support-main-video-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="support-main-video-slider__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="support-main-video-slider__item-image">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					</div>
					<div class="support-main-video-slider__item__title"><?=htmlspecialchars_decode($arItem["NAME"])?></div>
				</a>
			</div>
		<?endforeach;?>
	</div>
<? endif; ?>
<div class="support-main-video-slider-slider__control js-video-slider-control-1">
              <button class="btn btn-primary-inverse btn-round" data-controls="prev">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
                      </svg>
              </button>
              <button class="btn btn-primary-inverse btn-round" data-controls="next">
                      <svg width="7" height="12">
                        <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                      </svg>
              </button><a href="/support/education/videouroki/" class="btn btn-primary-inverse">Все видеоуроки</a>
            </div>