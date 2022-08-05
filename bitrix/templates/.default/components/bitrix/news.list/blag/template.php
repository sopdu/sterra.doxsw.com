<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>
<?foreach($arResult['ITEMS'] as $arItems):?>
	
	<div class="twelve tabs-page conference">
		<div class="images left">
		<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
			<a class="fancybox" href="<?=$arItems['ORIG_PICTURE']['SRC']?>"><img class="left" src="<?=$arItems['PREVIEW_PICTURE']['src']?>" alt="#"/></a>
		<?endif?>
		</div>						
		<div class="left conf-news">
			<h2><a href="<?=$arItems['DETAIL_PAGE_URL']?>#tab2"><?=$arItems['NAME']?></a></h2>
			<i><?=$arItems['CITY']['VALUE']?></i>
			<p><?=$arItems['PREVIEW_TEXT']?></p>
		</div>
		<div class="clearfix"></div>
	</div>

<?endforeach?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>		
<?$frame -> end();?>
