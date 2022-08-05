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
	<div class="home-page__cases">
		<? if(count($arResult["ITEMS"])): ?>
		<!-- CASES -->
		<div class="home-cases">
			<div class="container">
				<h2 class="h1 home-cases__title">Истории сотрудничества</h2>
			</div>
			<div class="home-cases__slider" id="cases-slider">
				<div class="scroll-slider">
					<div class="scroll-slider-viewport">
						<div class="scroll-slider-slides">
							<?foreach($arResult["ITEMS"] as $arItem):
								$href = $arItem["DETAIL_PAGE_URL"];
								if($arItem["PROPERTIES"]["HREF"]["VALUE"]!="") {
									$href = $arItem["PROPERTIES"]["HREF"]["VALUE"];
								}
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<!-- SLIDE-->
							<section class="scroll-slider-slide c-col-6 c-col-lg-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a class="home-case card" href="<?=$href?>">
									<div class="home-case__logo">
										<? if(is_array($arItem["PREVIEW_PICTURE"])) { ?>
											<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
										<? } else { ?>
											<div class="image-placeholder"></div>
										<? } ?>
									</div>
									<h3 class="home-case__title"><?=$arItem["NAME"]?></h3>
									<div class="home-case__text"><?=$arItem["PREVIEW_TEXT"]?></div>
								</a>
							</section>
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
							</button><a class="btn btn-primary-inverse scroll-slider-link" href="/partnery/cases/">Все кейсы</a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /CASES -->
		<? endif; ?>
	</div>