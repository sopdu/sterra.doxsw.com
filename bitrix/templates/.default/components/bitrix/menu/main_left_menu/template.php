<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>
<?
$flag = false;
$productsParentkey = NULL;
$subProductsParentkey = NULL;
foreach( $arResult as $key => $arItem){
    if ($arItem["DEPTH_LEVEL"] == 2) {
        $productsParentkey = $key;
    }
    if ($arItem["DEPTH_LEVEL"] == 3){
        $subProductsParentkey = $key;
    }
    if (($arItem["DEPTH_LEVEL"] == 3) && $arItem["SELECTED"]){
        $arResult[$productsParentkey]["PARAMS"]["CHILD_SELECTED"] = 1;
    }
    if (($arItem["DEPTH_LEVEL"] == 4) && $arItem["SELECTED"]){
        $arResult[$subProductsParentkey]["PARAMS"]["CHILD_SELECTED"] = 1;
        $arResult[$productsParentkey]["PARAMS"]["CHILD_SELECTED"] = 1;
    }
}
?>

<?if (!empty($arResult)):?>

	<div class="four left left-sidebar">
	
	<?

	$previousLevel = 0;
        $parentProductKey = 0;
	foreach($arResult as $key => $arItem):
	?>
	
		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>

		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>

		<?endif?>

                <?
                if ($arItem["DEPTH_LEVEL"] == 2) $parentProductKey = $key;
                ?>
		
		<?if ($arItem["IS_PARENT"]):?>



		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			
			<?if($arItem['SELECTED'] == 1):?>
				<a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a>
			<?else:?>
				<a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a>
			<?endif?>
				<ul class='left-menu-element-top'>

		<?else:?>

                                <li <?if($arItem["PARAMS"]["CHILD_SELECTED"]):?> class="sub-current"<?else:?> class="sub-no-current"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                               <?if ($arItem["PARAMS"]["CHILD_SELECTED"]):?>
	                               <?if (($arItem["PARAMS"]["CHILD_SELECTED"]) && ($arItem["PARAMS"]["DEPTH_LEVEL"] == '2') && ($arItem["PARAMS"]["IS_PARENT"])):?>

				<ul class='left-menu-element-has-siblibgs-visible' id="<?=$arItem["PARAMS"]["CODE"]?>-ul-id">
    	                           <?else:?>
				<ul class='left-menu-element-visible' id="<?=$arItem["PARAMS"]["CODE"]?>-ul-id">
                   		            <?endif?>
                               <?else:?>
                                <ul class='left-menu-element-hidden' id="<?=$arItem["PARAMS"]["CODE"]?>-ul-id">
                               <?endif?>

		<?endif?>



	<?else:?>



		<?if ($arItem["PERMISSION"] > "D"):?>


			
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>

				<?if(($arItem['SELECTED'] == 1)):?>
					<a href="<?=$arItem["LINK"]?>" class="sub-current"><p><?=$arItem["TEXT"]?></p></a>
				<?else:?>
					<a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a>
				<?endif?>

			<?else:?>
				<?if(($arItem['SELECTED'] == 1)):?>
					<li 
                                            <?if ($arItem['DEPTH_LEVEL'] >= 3) :?> 
                                               class="sub-current-deep-level-active" 
                                             <?else:?> 
                                               class="sub-current" 
                                             <?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
				<?else:?>
					<li 
                                            <?if ($arItem['DEPTH_LEVEL'] >= 3) :?>
                                               <?if ($arItem["PARAMS"]["IS_LAST_VERSION"] && !isset($arResult[$parentProductKey]["PARAMS"]["CHILD_SELECTED"])):?>
                                                 class="sub-current-deep-level-last-version"
                                               <?else:?>
                                                 class="sub-current-deep-level-inactive"
                                               <?endif?>
                                            <?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
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
<?endif?>
</div>

<?$frame -> end();?>
