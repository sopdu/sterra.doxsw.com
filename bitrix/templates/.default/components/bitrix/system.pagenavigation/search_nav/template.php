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
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="twelve tabs-page pagination align">	
	
		
		
		<div class="navigation">

		
		<?if ($arResult["NavPageNomer"] <= $arResult["NavPageCount"]):?>
		
			

			<?if($arResult["bSavePage"]):?>
					
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
						<div class="toleft left">
							<div class="icons"></div>
						</div>
					</a>
				
					<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
						
						<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
							<div class="toleft left">
								<div class="icons"></div>
							</div>
						</a>		
	
					<?else:?>
						
						<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
							<div class="toleft left">
								<div class="icons"></div>
							</div>
						</a>						
					<?endif?>
					
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
					<div class="toleft left">
						<div class="icons"></div>
					</div>
				</a>	
			<?endif?>
			<?else:?>
				<a href="#">
					<div class="toleft left">
						<div class="icons"></div>
					</div>
				</a>
			<?endif?>

			
			
		<div class="nav-pages">	
		
		<?while($arResult["nStartPage"] <= $arResult['nEndPage']):?>
			
				
			<?if($arResult["nStartPage"] < $arResult['nEndPage']):?>
				<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
					<a href="#"><div class="nav-current"><?=$arResult["nStartPage"]?></div></a>
				<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
					<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><div><?=$arResult["nStartPage"]?></div></a>
				<?else:?>
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><div><?=$arResult["nStartPage"]?></div></a>
				<?endif?>				
			<?else:?>
					<?/*?><a href="#" onclick="return false;"><div class="dots">...</div></a><?*/?>
					<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
						<a href="#"><div class="nav-current"><?=$arResult["nStartPage"]?></div></a>
					<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
						<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><div><?=$arResult["nStartPage"]?></div></a>
					<?else:?>
						<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><div><?=$arResult["nStartPage"]?></div></a>
					<?endif?>	
			<?endif?>	
			
			
			<?$arResult["nStartPage"]++?>
						
		<?endwhile?>
		<?
		?>

		</div>

		<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<a class="new-next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
				<div class="toright left">
					<div class="icons"></div>
				</div>
			</a>			
		<?else:?>
			<a href="#">
				<div class="toright left">
					<div class="icons"></div>
				</div>
			</a>
		<?endif?>
		
			
		</div>
		<div class="clear"></div>
		
		<?if ($arResult["bShowAll"]):?>
		
			<?if ($arResult["NavShowAll"]):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" class="right"><?=GetMessage("nav_paged")?></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" class="right"><?=GetMessage("nav_all")?></a>
			<?endif?>
		
		<?endif?>
		
</div>