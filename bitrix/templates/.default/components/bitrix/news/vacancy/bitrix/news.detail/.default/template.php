<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div style="overflow: hidden">
		<div class="clearfix"></div>

		<?if(!empty($arResult['PREVIEW_PICTURE']['src'])):?>
			<img src="<?=$arResult['PREVIEW_PICTURE']['src']?>" style="float:left; padding-right: 30px; "/>
		<?endif?>	
		
		<?echo $arResult['PREVIEW_TEXT']?>
	</div>	
	<br />
	<br />
	<div class="twelve">
		<a href="<?=$arResult['LIST_PAGE_URL']?>" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

<?$frame -> end();?>