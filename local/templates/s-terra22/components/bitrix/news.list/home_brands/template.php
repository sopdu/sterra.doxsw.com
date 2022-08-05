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
	<!-- CLIENTS -->
	<div class="home-clients">
		<div class="scroll-slider" id="clients-slider">
			<div class="scroll-slider-viewport">
				<div class="scroll-slider-slides">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<!-- SLIDE-->
						<div class="scroll-slider-slide c-col-4 c-col-md-3 c-col-lg-2" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<a class="card client-block" href="javascript:void(0);" rel="noopener noreferrer nofollow">
								<img class="bw" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
								<img class="colored" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="">
							</a>
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
		</div>
	</div><!-- /CLIENTS -->
<? endif; ?>
