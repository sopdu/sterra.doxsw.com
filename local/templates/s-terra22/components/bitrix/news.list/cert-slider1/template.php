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
	<div class="catalog-compl-sertificates-slider js-sert-slider-2">
		<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<div class="catalog-compl-sertificates__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="catalog-compl-sertificates__item__wrap" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"])?>" target="_blank">
					<div class="catalog-compl-sertificates__item-image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
					<div class="catalog-compl-sertificates__item-content">
						<div class="catalog-compl-sertificates__item__title"><?=$arItem["NAME"]?></div>
						<div class="catalog-compl-sertificates__item__subtitle"><?=$arItem["PROPERTIES"]["TYPE"]["VALUE"]?></div>
						<div class="catalog-compl-sertificates__item__description">
							<ul>
								<li><?=(strip_tags($arItem["DISPLAY_PROPERTIES"]["PRODUCT"]["DISPLAY_VALUE"]))?></li>
								<li>От <?=$arItem["ACTIVE_FROM"]?></li>
							</ul>
						</div>
					</div>
				</a>
			</div>
		<?endforeach;?>
	</div>
<? endif; ?>