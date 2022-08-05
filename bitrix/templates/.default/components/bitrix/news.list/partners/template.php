<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right">
					<h1><?=GetMessage('CT_BUSINESS_PARTNERS')?></h1>
					<div class="clearfix"></div>
					<br />

<div class="section">

<ul class="tabs">
	<?foreach($arResult['SECTION_ITEMS'] as $key => $arSection):?>
	
		<?if($key == 0 && $arSection['ELEMENT_CNT'] > 0):?>
			<li class="current tab"><a href="#tab<?=$key?>"><b><div class="icon icon-medal gold-medal"></div><?=$arSection['NAME']?></b></a></li>
		<?elseif($key > 0 && $arSection['ELEMENT_CNT'] > 0):?>	
			<li class="tab"><a href="#tab<?=$key?>"><b><div class="icon icon-medal silv-medal"></div><?=$arSection['NAME']?></b></a></li></li>
		<?endif?>
		
	<?endforeach?>	
</ul>
<?foreach($arResult['SECTION_ITEMS'] as $key => $arSection):?>
		
		<?if($key == 0 && $arSection['ELEMENT_CNT'] > 0):?>
		
		<?foreach($arResult['ITEMS'] as $arItems):?>
		<?if($arItems['IBLOCK_SECTION_ID'] == $arSection['ID']):?>
		<div class="box visible">
			<div class="twelve tabs-page conference">
				<div class="images left">
				<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
					<img class="left" src="<?=$arItems['PREVIEW_PICTURE']['src']?>" alt="#"/>
				<?endif?>
				</div>						
				<div class="left conf-news">
					<a href="<?=$arItems['DETAIL_PAGE_URL']?>"><?=$arItems['NAME']?></a><br />
					<i><?=$arItems['PROPERTIES']['CITY']['VALUE']?></i>
					<b><?=$arItems['PREVIEW_TEXT']?></b>
				</div>
				<div class="clearfix"></div>
			</div>
			<?endif?>
	<?endforeach?>

	<div class="clearfix"></div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>	
</div>
			
								

		
	<?elseif($key > 0 && $arSection['ELEMENT_CNT'] > 0):?>	
		
		<div class="box">
		<?foreach($arResult['ITEMS'] as $arItems):?>
			<?if($arItems['IBLOCK_SECTION_ID'] == $arSection['ID']):?>
			
			<div class="twelve tabs-page conference">
				<div class="images left">
				<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
					<img class="left" src="<?=$arItems['PREVIEW_PICTURE']['src']?>" alt="#"/>
				<?endif?>
				</div>						
				<div class="left conf-news">
					<a href="<?=$arItems['DETAIL_PAGE_URL']?>"><?=$arItems['NAME']?></a><br />
					<i><?=$arItems['CITY']['VALUE']?></i>
					<b><?=$arItems['PREVIEW_TEXT']?></b>
				</div>
				<div class="clearfix"></div>
			</div>
			<?endif?>
	<?endforeach?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>			
		</div>
	<?endif?>
<?endforeach?>						
	</div>
</div>

<?$frame -> end();?>