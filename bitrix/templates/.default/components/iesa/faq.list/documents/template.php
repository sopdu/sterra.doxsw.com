<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="twelve right">
	<h1><?=GetMessage('CT_DOCUMENTS')?></h1>
	<div class="clearfix"></div>
	<br />
<!--<div class="twelve soft-blue doc-search">
		<form action="index.php" method="GET">
			<input type="text" placeholder="Поиск по документам"/>
			<input type="submit" value="Найти" class="blue right"/>
			<div class="round-button right icon-arrow-next"></div>
		</form>
	</div>	 -->	
	<div class="section">

		<ul class="tabs">
		<?foreach($arResult['SECTION'] as $key => $arSection):?>
			<?if($key == 0):?>
				<li class="current tab"><a href="#tab<?=$key?>"><b><?=$arSection['NAME']?></b></a></li>
			<?else:?>
				<li class="tab"><a href="#tab<?=$key?>"><b><?=$arSection['NAME']?></b></a></li>
			<?endif?>
		<?endforeach?>
		</ul>
		<?foreach($arResult['SECTION'] as $key => $arSection):?>
			<?if($key == 0):?>	
			<div class="box visible">
				<?foreach($arResult['ITEMS'] as $arItems):?>
				
					<?if($arItems['IBLOCK_SECTION_ID'] == $arSection['ID']):?>
			
					
						<a href="#<?=$arItems['ID']?>"><div class="solution-files soft-grey title">
							<h3><?=$arItems['NAME']?></h3>
						</div></a>
						<?foreach($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] as $arFiel):?>
							<div class="solution-files">
								<div class="file-icon-1 icons"></div>
								<p><?=$arFiel['ORIGINAL_NAME']?></p>
								<a href="<?=$arFiel['SRC']?>"><?=GetMessage('CT_LOOK')?></a><a href="/include/save_file.php?filename=..<?=$arFiel['SRC']?>"><?=GetMessage('CT_DOWNLOAD')?></a>
								<b><?=$arFiel['CONTENT_TYPE']?>, <?=HumanBytes($arFiel['FILE_SIZE'])?></b>
							</div>
						<?endforeach?>
					</div>
					<?endif?>
				<?endforeach?>
			</div>
			<?else:?>	
			<div class="box">
				<?foreach($arResult['ITEMS'] as $arItems):?>
				<?if($arItems['IBLOCK_SECTION_ID'] == $arSection['ID']):?>
					
					<a href="#<?=$arItems['ID']?>"><div class="twelve tabs-page">	
						<div class="solution-files soft-grey title">
							<h3><?=$arItems['NAME']?></h3>
						</div></a>
						<?foreach($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] as $arFiel):?>
							
							<div class="solution-files">
								<div class="file-icon-1 icons"></div>
								<p><?=$arFiel['ORIGINAL_NAME']?></p>
								<a href="<?=$arFiel['SRC']?>"><?=GetMessage('CT_DOWNLOAD')?></a>
								<b><?=$arFiel['CONTENT_TYPE']?>, <?=HumanBytes($arFiel['FILE_SIZE'])?></b>
							</div>
						<?endforeach?>
					</div>
					<?endif?>
				<?endforeach?>			
			</div>
			<?endif?>	
		<?endforeach?>
	</div><!-- .section -->
</div>

