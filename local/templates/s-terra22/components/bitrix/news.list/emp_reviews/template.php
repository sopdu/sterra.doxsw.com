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
$this->setFrameMode(true);   //   echo "<pre>"; print_r($arResult); echo "</pre>";

use Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc;

?>
<? if(count($arResult["ITEMS"])): ?>
<div class="vacancies-review-slider">
	<?foreach($arResult["ITEMS"] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="review-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="review-item-wrap">
				<div class="review-item__image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
				<div class="review-item__text">
					<div class="review-item__text__title"><?=$arItem["NAME"]?></div>
					<div class="review-item__text__position"><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></div>
					<div class="review-item__text__content"><?=$arItem["PREVIEW_TEXT"]?></div>
				</div>
			</div>
		</div>
	<?endforeach;?>
</div>
<? endif; ?>