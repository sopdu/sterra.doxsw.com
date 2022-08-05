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

<div class="scroll-slider" id="work-slider">
	<? if(count($arResult["ITEMS"])): ?>
	<div class="scroll-slider-viewport">
		<div class="scroll-slider-slides">
			<?foreach($arResult["ITEMS"] as $arItem):
				$href = "";
				if(is_array($arItem["DISPLAY_PROPERTIES"]["PDF"]["FILE_VALUE"])) {
					$href = $arItem["DISPLAY_PROPERTIES"]["PDF"]["FILE_VALUE"]["SRC"];
				}
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="vacancies-work-slide scroll-slider-slide c-col-12 c-col-sm-6 c-col-lg-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="vacancies-work-slide-wrap">
						<div class="vacancies-work-slide__date"><?=$arItem["ACTIVE_FROM"]?></div>
						<div class="vacancies-work-slide__title"><?=$arItem["NAME"]?></div>
                        <?if ($href):?>
                        <a class="btn btn-primary-inverse" href="<?=$href?>" download>
							<svg class="btn-icon">
								<use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow"></use>
							</svg><span>Скачать PDF</span>
                        </a>
                        <?endif?>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
	<div class="container">
		<div class="scroll-slider-controls">
			<button class="scroll-slider-control scroll-slider-prev btn btn-round btn-primary-inverse" type="button">
				<svg width="7" height="12">
					<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
				</svg>
			</button>
			<button class="scroll-slider-control scroll-slider-next btn btn-round btn-primary-inverse" type="button">
				<svg width="7" height="12">
					<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
				</svg>
			</button>
		</div>
	</div>
	<? endif; ?>
</div>