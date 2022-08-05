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
					<?if($arItem['DATE_ACTIVE_FROM']):?>
						<span class="date">
							<?=FormatDate("j F Y", MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?> г.
						</span>
					<?endif;?>
					<h3 style="padding:0px 0px 9px 0px;"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
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
