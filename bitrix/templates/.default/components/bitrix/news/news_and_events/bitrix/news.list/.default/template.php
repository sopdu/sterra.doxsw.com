<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article awards">


		
<div class="twelve">
<h1><?=$APPLICATION->GetTitle();?></h1>

		<?foreach($arResult["ITEMS"] as $arItem):?>
			
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			
			<div class="twelve tabs-page sertificates" id="<?=$this->GetEditAreaId($arItem['ID']);?>">	
				
				<div class="images left">
				<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
					<img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>"/>
				<?endif?>
				</div>
				<div class="apear left conf-news">
					<a href="<?if(!empty($arItem['DISPLAY_PROPERTIES']['REF_LINK']["VALUE"])):?><?=$arItem['DISPLAY_PROPERTIES']['REF_LINK']["VALUE"]?><? else: ?><?=$arItem['DETAIL_PAGE_URL']?><?endif?>"><?=$arItem['NAME']?></a>
					<?if($arItem['DATE_ACTIVE_FROM'] && $arItem['DATE_ACTIVE_TO']):?>
						<i class="date">
							<?=FormatDate("j F", MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?> &#8212
							<?=FormatDate("j F Y", MakeTimeStamp($arItem['DATE_ACTIVE_TO']))?> г.
						</i>
					<?elseif($arItem['DATE_ACTIVE_FROM']):?>
						<i class="date">
							<?=FormatDate("j F Y", MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?> г.
						</i>
					<?endif;?>
					<span><?=$arItem['PREVIEW_TEXT']?></span>
				</div>
				<div class="clearfix"></div>
			</div>
		<?endforeach?>		
		<div class="clearfix"></div>
		
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>	
</div>
							
<?$frame -> end();?>
