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
<div class="container">
          <div class="cases-page-title">Кейсы</div>
	<div class="cases-page-grid">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="partner-history-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="partner-history-slider__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<?if ($arItem["PREVIEW_PICTURE"]["SRC"]){?>
					<div class="product-card-video-slider__item-image">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					</div>
						<?}else{?>
					<div class="partner-history-slider__item__image partner-history-slider__item__image__placeholder">
						<img src="/local/templates/s-terra22/images/placeholder.svg">
					</div>
					<?}?>
					<div class="partner-history-slider__item__title"><?=$arItem["NAME"]?></div>
						<div class="partner-history-slider__item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
				</a>
			</div>
		<?endforeach;?>
	</div>
 <div class="vacancies-vacant__controll js-control-text-cases-show">
            <div class="vacancies-vacant__controll__text js-control-text-cases">Показано 3 из 9</div>
            <button class="js-control-more-cases vacancies-vacant__controll__btn btn btn-primary-inverse">Еще 3</button>
          </div>
</div>