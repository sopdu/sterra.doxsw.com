<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div style="overflow: hidden">
		<div class="clearfix"></div>
		<br />
		<?if(!empty($arResult['PREVIEW_PICTURE']['src'])):?>
			<img src="<?=$arResult['PREVIEW_PICTURE']['src']?>" style="float:left; padding-right: 30px; "/>
		<?endif?>	
		<br />
		<?echo $arResult['PREVIEW_TEXT']?>
	</div>
	<div class="twelve right solution-files-container">
		<?if(!empty($arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['SRC'])):?>
		<div class="twelve solution-files">
			<div class="file-icon-1 icons"></div>
			<p><?=$arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['ORIGINAL_NAME']?></p>
			<a href="<?=$arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['SRC']?>"><?=GetMessage('CT_SAVE')?></a>
			<b><?=$arResult['PROPERTIES']['FILE_FOR_SAVE']['FILE_TYPE']?>, <?=HumanBytes($arResult['PROPERTIES']['FILE_FOR_SAVE']['VALUE']['FILE_SIZE'])?></b>					
		</div>
		<?endif?>
	</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<div class="twelve">
		<a href="<?=$arResult['LIST_PAGE_URL']?>" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

<?$frame -> end();?>