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
		<div class="container">
			<div class="superior-grid">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="superior-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="superior-item-wrap">
							<div class="superior-item__img">
								<svg>
									<use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#about-number-<?=$arItem["SORT"]?>"></use>
								</svg>
							</div>
							<div class="superior-item__title"><?=$arItem["NAME"]?></div>
							<div class="superior-item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
<? endif; ?>
