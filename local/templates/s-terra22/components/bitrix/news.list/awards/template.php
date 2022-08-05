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
$this->setFrameMode(true);    //  echo "<pre>"; print_r($arResult); echo "</pre>";

use Bitrix\Main\Localization\Loc;

?>
<div class="awards-page__body row">
	<? if(count($arResult["ITEMS"])): ?>
		<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="js-item col col-12 col-md-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="awards-page__item" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="awards-page__item__image"><? if(is_array($arItem["PREVIEW_PICTURE"])) { ?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
						<? } else { ?>
							<div class="image-placeholder">
							<img src="/local/templates/s-terra22/images/placeholder.svg">
						</div>
						<? } ?></div>
					<div class="awards-page__item__text">
						<div class="awards-page__item__title"><?=$arItem["NAME"]?></div>
						<div class="awards-page__item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
					</div>
				</a>
			</div>
		<?endforeach;?>
	<? endif; ?>
</div>