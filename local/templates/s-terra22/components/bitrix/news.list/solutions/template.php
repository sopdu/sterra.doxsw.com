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

use Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc;

?>
<? if(count($arResult["ITEMS"])): ?>
<div class="catalog-block__body row">
	<?foreach($arResult["ITEMS"] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="js-item col col-12 col-sm-6 col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a class="catalog-block__item" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="catalog-block__item__title"><?=$arItem["NAME"]?></div>
			<div class="catalog-block__item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
			<div class="catalog-block__item__icon">
				<?/*  на главной у нас картинка анонса, здесь почему-то иконка...*/?>
				<?/*<svg width="66" height="66">
					<use xlink:href="#i-catalog-1" href="#i-catalog-1"></use>
				</svg>*/?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
			</div>
		</a>
	</div>
	<?endforeach;?>
</div>
<? endif; ?>
