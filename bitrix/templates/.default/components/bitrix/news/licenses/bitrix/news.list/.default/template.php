<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<div class="clearfix"></div>
<div class="twelve tabs-pages">
	
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="twelve tabs-page conference"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
					<div class="images left">	
							
							<a class="fancybox" rel="group" href="<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>"><img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>"/></a>				
					</div>
				<?endif?>				
				<div class="left conf-news lic">
					<span><?=$arItem['NAME']?></span><br />
					<i><?=substr($arItem['PROPERTIES']['DATE_FROM']['VALUE'],0, 10)?> &#8212 <?!empty($arItem['PROPERTIES']['DATE_TO']['VALUE']) ? $val=substr($arItem['PROPERTIES']['DATE_TO']['VALUE'],0, 10) : $val="бессрочно"?><?=$val?></i><br />
					<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
					
				</div>
				<div class="twelve right solution-files-container">
					<?if(!empty($arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['SRC'])):?>
					<div class="twelve solution-files">
						<div class="image_wrapper"><img src="/img/pdf-icon.png"/></div>

						<?/*<img src="/img/pdf-icon.jpg" />*/?>
						<div class="text_wrapper">
							<b><?=$arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['ORIGINAL_NAME']?></b><br>
							<a href="<?=$arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['SRC']?>" target="_balnk"><?=GetMessage('CT_LOOK')?></a>
							<a href="/include/save_file.php?filename=<?=$arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['ID']?>"><?=GetMessage('CT_SAVE')?></a>
							<?=$arItem['PROPERTIES']['FILE_FOR_SAVE']['FILE_TYPE']?>, <?=HumanBytes($arItem['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'])?>					
						</div>
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