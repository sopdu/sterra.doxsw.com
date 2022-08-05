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
<div class="tab-body__item" type="button" data-type="all">
	<? if(count($arResult["ITEMS"])): ?>
	<div class="about-team-slider">
		<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
			</div>
		<? endforeach; ?>
	</div>
	<div class="about-team-slider-thumbnails-wrap">
		<ul class="about-team-slider-thumbnails" id="about-team-slider-thumbnails">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<li><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"></li>
			<? endforeach; ?>
		</ul>
	</div>
	<? endif; ?>
</div>