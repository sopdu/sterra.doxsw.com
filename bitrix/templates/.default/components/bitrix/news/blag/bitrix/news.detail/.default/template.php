<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<br /><br /><br />
<div class="twelve right article">
	<h3><?=$arResult['NAME']?></h3>
	<div style="overflow: hidden">
		<div class="clearfix"></div>
		<br />
		<?if(!empty($arResult['DETAIL_PICTURE']['src'])):?>
			<img src="<?=$arResult['DETAIL_PICTURE']['src']?>" style="float:left; padding-right: 30px; "/>
		<?endif?>	
		<br />
		
			<?echo $arResult['DETAIL_TEXT']?>
	</div>
	<br />
	<br />
	<div class="twelve">
		<a href="/company/awards_and_appreciation/#tab2" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

<?$frame -> end();?>