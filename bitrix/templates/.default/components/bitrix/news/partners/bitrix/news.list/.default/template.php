<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

	<?foreach($arResult['ITEMS'] as $arItems):?>
			<?if($arItems['PROPERTIES']['REGION']['VALUE'] == $_POST['select'] ||  $_POST['select'] == ""):?>
				<div class="twelve tabs-page conference">
					<div class="images left">
					<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
						<img class="left" src="<?=$arItems['PREVIEW_PICTURE']['src']?>" alt="#"/>
					<?endif?>
					</div>						
					<div class="left conf-news">
						<a href="<?=$arItems['DETAIL_PAGE_URL']?>"><?=$arItems['NAME']?></a><br />
						<i><?=$arItems['PROPERTIES']['CITY']['VALUE']?></i>
						<i><?=$arItems['PROPERTIES']['REGION']['VALUE']?></i>
						<b><?=$arItems['PREVIEW_TEXT']?></b>
					</div>
					<div class="clearfix"></div>
				</div>			
			<?endif?>
			
	<?endforeach?>

	<div class="clearfix"></div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif?>	
				
<?if(!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) == 0) { ?><br /><br /><? ShowError('В данном разделе партнёров пока нет. Но обязательно будут позже! ');?><?}?>

<?$frame -> end();?>
<script>
/*	$(function(){
		$("#region").change(function(){
			
			location.href='?region='+$("#region").val();
			
		
		});
		$("#city").change(function(){
			
			location.href='?region='+$("#region").val()+'&city='+$("#city").val();
			
		
		});		
	});*/
</script>	