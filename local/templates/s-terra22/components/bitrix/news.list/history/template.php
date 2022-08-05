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
	<div class="about-history-slider">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="history__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"">
				<div class="history__item-wrap">
					<div class="history__item-title"><?=$arItem["NAME"]?></div>
					<div class="history__item-text"><?=$arItem["PREVIEW_TEXT"]?></div>
					<div class="history__item-social">
						<div class="apps colored">
							<ul class="apps-list">
								<!--<li><a class="app-icon app-icon-fb" href="https://www.facebook.com/pg/STerra.CSP/posts/?ref=page_internal" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/fb.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/fb-color.png"></a></li>-->
								<li><a class="app-icon app-icon-yt" href="https://www.youtube.com/c/STerraCSP/" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/yt.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/yt-color.png"></a></li>
								<li><a class="app-icon app-icon-vk" href="https://vk.com/sterra_csp" target="_blank" rel="noopener noreferrer nofollow"><img class="icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/vk.png"><img class="colored-icon" src="<?=SITE_TEMPLATE_PATH?>/images/apps/vk-color.png"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
<? endif; ?>
