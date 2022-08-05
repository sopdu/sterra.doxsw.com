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
<div class="catalog-compl-sertificates-slider js-sert-slider-1">
	<?foreach($arResult["ITEMS"] as $arItem):
		/*$arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"] = explode(" ", $arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"])[0];
		$arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"] = explode(" ", $arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"])[0];*/
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
		<div class="catalog-compl-sertificates__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="catalog-compl-sertificates__item__wrap" href="<?//=CFile::GetPath($arItem["PROPERTIES"]["file"]["VALUE"])?>" target="_blank">
				<!--<div class="catalog-compl-sertificates__item-image"><img src="<?/*=$arItem["PREVIEW_PICTURE"]["SRC"]*/?>"></div>-->




                <div class="catalog-compl-sertificates__item-image my-gallery" data-pswp-uid="1">
                    <figure>
                        <a class="big-img" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                        </a>
                    </figure>
                </div>

				<div class="catalog-compl-sertificates__item-content">
					<div class="catalog-compl-sertificates__item__title"><?=$arItem["NAME"]?></div>
					<div class="catalog-compl-sertificates__item__description">
						<ul>
                            <li>На <b><?=(strip_tags($arItem["DISPLAY_PROPERTIES"]["PRODUCT"]["DISPLAY_VALUE"]))?></b></li>
							<li>От <?=(explode(" ", $arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"])[0])?></li>
                            <?if ($arItem["PROPERTIES"]["CRIPTOGRAFY"]["VALUE"]):?>
							<li>Криптография: <?=(implode(", ", $arItem["PROPERTIES"]["CRIPTOGRAFY"]["VALUE"]))?></li>
                            <?endif?>
							<li>Действителен до <?=(explode(" ", $arItem["PROPERTIES"]["ACTIV_TO"]["VALUE"])[0])?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?endforeach;?>
</div>
<? endif; ?>