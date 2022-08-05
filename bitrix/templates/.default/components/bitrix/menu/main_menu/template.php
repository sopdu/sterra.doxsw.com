<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<?if (!empty($arResult)):?>
<div id="menu" class="left">			
	<ul id="nav">
	
	<?

	$previousLevel = 0;

	foreach($arResult as $arItem):
	
	?>
	
		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>

		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>

		<?endif?>
		
		<?if ($arItem["IS_PARENT"]):?>



		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			
			<?if($arItem['SELECTED'] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>"><div class="current"><?=$arItem["TEXT"]?></div></a>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a>
			<?endif?>
				<ul>

		<?else:?>

			<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a>

				<ul>

		<?endif?>



	<?else:?>



		<?if ($arItem["PERMISSION"] > "D"):?>



			<?if ($arItem["DEPTH_LEVEL"] == 1):?>

				<?if($arItem['SELECTED'] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>"><div class="current"><?=$arItem["TEXT"]?></div></a>
				<?else:?>
					<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a>
				<?endif?>

			<?else:?>

				<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a></li>

			<?endif?>



		<?else:?>



			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				
				<?if($arItem['SELECTED'] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>"><div class="current"><?=$arItem["TEXT"]?></div></a>
				<?else:?>
					<li><a href="<?=$arItem["LINK"]?>"><div><?=$arItem["TEXT"]?></div></a>
				<?endif?>

			<?else:?>

				<li><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><div><?=$arItem["TEXT"]?></div></a></li>

			<?endif?>



		<?endif?>



	<?endif?>



	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>



<?if ($previousLevel > 1)://close last item tags?>

	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>

<?endif?>			
		</ul>
	</div>
<?endif?>


<?$frame -> end();?>