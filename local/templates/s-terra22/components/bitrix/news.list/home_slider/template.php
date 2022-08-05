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

$active = true;
?>
	<div class="home-page__jumbotron"><!-- JUMBOTRON -->
		<? if(count($arResult["ITEMS"])): ?>
		<div class="jumbotron">
			<div class="container">
				<div class="fade-slider" id="home-slider" data-auto>
					<div class="fade-slider-slides">
						<?foreach($arResult["ITEMS"] as $arItem):
							$but_text = $arItem["PROPERTIES"]["BUTTON"]["VALUE"];
							if(!$but_text) {
								$but_text = "Подробнее";
							}
							$active_text = "";
							if($active) {
								$active_text = " active";
								$active = false;
							}
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
						<!-- SLIDE-->
						<section class="fade-slider-slide<?=$active_text?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="home-banner">
								<div class="home-banner__content">
									<div class="home-banner__text"><?=$arItem["PREVIEW_TEXT"]?></div>
									<a class="btn btn-accent" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">Выбрать решение</a>
								</div>
                                <div class="home-banner__img">
                                <?if ($arItem['DETAIL_TEXT']):?>
                                    <?=$arItem['DETAIL_TEXT']?>
                                <?else:?>
                                    <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="">
                                <?endif?>
								</div>
							</div>
						</section>
						<?endforeach;?>
					</div>
					<div class="fade-slider-pagination"></div>
				</div>
			</div>
		</div><!-- /JUMBOTRON -->
		<? endif; ?>
	</div>