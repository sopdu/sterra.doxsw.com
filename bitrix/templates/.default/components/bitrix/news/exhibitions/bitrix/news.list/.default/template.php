<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">

	<div class="clearfix"></div>
	<h1><?=$APPLICATION->GetTitle()?></h1>
	<div class="otstup"></div>
	
<div class="twelve tabs-pages">
	
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="twelve tabs-page conference"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				<div class="images left">
					<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
						<img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>"/>
					<?endif?>
				</div>							
				<div class="left conf-news">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
					<?if($arItem['PROPERTIES']['FROM']['VALUE'] && $arItem['PROPERTIES']['TO']['VALUE']):?>
						<i class="date">
							<?=FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['FROM']['VALUE']))?> &#8212
							<?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['TO']['VALUE']))?> г.
						</i>
					<?elseif($arItem['PROPERTIES']['FROM']['VALUE']):?>
						<i class="date">
							<?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['FROM']['VALUE']))?> г.
						</i>
					<?endif;?>
				
					<b class="black"><?=$arItem['PROPERTIES']['PLACE']['VALUE']?></b>
					<?=$arItem['PREVIEW_TEXT']?>
				</div>
				<div class="twelve right solution-files-container">
					<?if(!empty($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC'])):?>
					<div class="twelve solution-files">
						<div class="file-icon-1 icons"></div>
						<p><?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['ORIGINAL_NAME']?></p>
						<a href="<?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC']?>"><?=GetMessage('CT_SAVE')?></a>
						<b><?=$arItem['PROPERTIES']['SAVE_FILE']['FILE_TYPE']?>, <?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE']?></b>					
					</div>
					<?endif?>
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