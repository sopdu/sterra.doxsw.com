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
	<div class="industry-card-clients-slider js-clients-slider-1">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="industry-card-clients__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<a class="industry-card-clients__item__wrap" href="javascript:void(0);">
								<div class="industry-card-clients__item__image">
									<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
								</div>
							</a>
						</div>
					<?endforeach;?>
	</div>
<? endif; ?>
