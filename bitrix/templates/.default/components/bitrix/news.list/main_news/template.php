<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="content kilo">
	<div class="title_kilo soft-blue">
		<h3><?=GetMessage('NEWS')?></h3>
		<a href="/company/news/" class="button right blue"><?=GetMessage('ALL_NEWS')?><div class="round-button right icon-arrow-next"></div></a>
	</div>	
	<div class="clearfix"></div>	
	<section class="news-block">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>	
		<?
			$arItem['ACTIVE_FROM'] = EditData($arItem['ACTIVE_FROM']);
		?>
		<div>
		<a href="<?if(!empty($arItem['DISPLAY_PROPERTIES']['REF_LINK']["VALUE"])):?><?=$arItem['DISPLAY_PROPERTIES']['REF_LINK']["VALUE"]?><? else: ?><?=$arItem['DETAIL_PAGE_URL']?><?endif?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="news one_third">
				<div class="date">
						
					<p><?=$arItem['ACTIVE_FROM']['DAY']?></p>

					<p><?=$arItem['ACTIVE_FROM']['MONTH']?></p>
			
				</div>
				<div class="news-text">
					<h3><?=$arItem['NAME']?></h3>
					<p><?=$arItem['PREVIEW_TEXT']?></p>
				</div>
			</div>
		</a>
	</div>		
	<?endforeach;?>		
	</section>				
</div>
<?$frame -> end();?>