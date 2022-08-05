<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>
<?$frame = $this -> createFrame() -> begin();?>
<?if (!empty($arResult)):?>
	<div class="four left left-sidebar">
	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):
	?>
		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>
		<?if ($arItem["IS_PARENT"]):?>			
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>				
				<?if($arItem['LINK'] == $APPLICATION->GetCurPage()):?>						
						<a href="<?=$arItem["LINK"]?>" class="sub-current"><p><?=$arItem["TEXT"]?></p></a>
				<?else:?>
					<a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a>
				<?endif;?>
					<ul>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<ul>
			<?endif?>
		<?else:?>
			<?if ($arItem["PERMISSION"] > "D"):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<?if($arItem['SELECTED'] == 1):?>						
						<a href="<?=$arItem["LINK"]?>" class="sub-current"><p><?=$arItem["TEXT"]?></p></a>
					<?else:?>
						<a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a>
					<?endif?>
				<?else:?>
					
					<?if($arItem['SELECTED'] == 1):?>						
						<li><a class="sub-current" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?endif?>
			<?else:?>			
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<?if($arItem['SELECTED'] == 1):?>
						
						<li><a href="<?=$arItem["LINK"]?>"><div class="current"><?=$arItem["TEXT"]?></div></a>
					<?else:?>
						<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a>
					<?endif?>
				<?else:?>
					<li><a href=""><?=$arItem["TEXT"]?></a></li>
				<?endif?>
			<?endif?>
		<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1)://close last item tags?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>	
					</div>
<?endif?>


<?$frame -> end();?>
