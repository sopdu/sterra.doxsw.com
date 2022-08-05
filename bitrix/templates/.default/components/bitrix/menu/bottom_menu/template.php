<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<?if (!empty($arResult)):?>
<div class="kilo soft-grey">

<?

$previousLevel = 0;

foreach($arResult as $arItem):

?>



	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>

		<?=str_repeat("</ul></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>

	<?endif?>
	
	<?if ($arItem["IS_PARENT"]):?>
		
		
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<div class="four">
				<h5><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></h5>
				<ul>
			<?else:?>
			<div class="four">
				<h5><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></h5>
				<ul>
			<?endif?>
			
	<?else:?>	

		<?if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<div class="four">
					<h5><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></h5>
				</div>	
			<?else:?>
				<li><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>
			<?endif?>
		<?else:?>
		
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<div class="four">
					<h5><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></h5>
				</div>
			<?else:?>
				<li><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>
			<?endif?>
		
		<?endif?>
				
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	
<?endforeach?>

	
<?if ($previousLevel > 1)://close last item tags?>

	<?=str_repeat("</ul></div>", ($previousLevel-1) );?>

<?endif?>
	
			
</div>	

<?endif?>

<?$frame -> end();?>
