<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="content two_third">
	<div class="title_two_third soft-blue">
		<h3><?=GetMessage('ADS')?></h3>
		<a href="/company/ads/" class="width-button right blue"><?=GetMessage('ALL_ADS')?><div class="round-button right icon-arrow-next"></div></a>
	</div>	
	<section class="news-block">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>	
		<div>
		<a href="<?if(!empty($arItem['PROPERTIES']['ADS_LINK']['VALUE'])):?><?=$arItem['PROPERTIES']['ADS_LINK']['VALUE']?><? else: ?><?=$arItem['DETAIL_PAGE_URL']?><?endif?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

			<div class="ads one_third">
				<div class="ads-text">
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