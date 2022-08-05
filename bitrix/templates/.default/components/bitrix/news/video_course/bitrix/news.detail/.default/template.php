<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div class="news" style="overflow: hidden">
		<div class="clearfix"></div>
		<?if(!empty($arResult['PREVIEW_PICTURE']['src'])):?>
			<div class="banner twelve" style="background: url('<?=$arResult['PREVIEW_PICTURE']['src']?>'); background-repeat: no-repeat;">
				<p class="title"></p>
				<p class="subtitle"></p>
			</div>
		<?endif?>	
		<?echo $arResult['DETAIL_TEXT']?>
	</div>
	<br />
	<br />
	<div class="twelve">
		<a href="<?=$arResult['LIST_PAGE_URL']?>" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

<?$frame -> end();?>