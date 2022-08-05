<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div style="overflow: hidden">
		<div class="otstup">
		<?if(!empty($arResult['PREVIEW_PICTURE']['SRC'])):?>
			<img src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" style="padding:0 30px 30px 0; max-width:100%; box-sizng-border-box; "/>
		<?endif?>	
		<?echo $arResult['DETAIL_TEXT']?>
	</div>
</div>
	<div class="twelve">
		<a href="<?=$arResult['LIST_PAGE_URL']?>" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

<?$frame -> end();?>