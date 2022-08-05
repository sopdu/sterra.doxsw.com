<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="twelve right">
	
	<div class="clearfix"></div>
	<br />
	
	<!--<div class="twelve soft-blue doc-search">
		<form action="index.php" method="GET">
			<input type="text" placeholder="Поиск по документам"/>
			<input type="submit" value="Найти" class="blue right"/>
			<div class="round-button right icon-arrow-next"></div>
		</form>
	</div>-->
	
	<div class="section">
		<?if(count($arResult['SECTION'] )>0):?>
		<ul class="tabs">
			<?foreach($arResult['SECTION'] as $key => $arSection):?>		
				<?if(count($arSection['ELEMENTS'])>0):?>
					<?$number = $key+1;?>	
					<?if($key == 0):?>
						<li class="current tab" id="tab<?=$number?>"><a href="#tab<?=$number?>"><b><?=$arSection['NAME']?></b></a></li>
					<?else:?>
						<li class="tab" id="tab<?=$number?>"><a href="#tab<?=$number?>"><b><?=$arSection['NAME']?></b></a></li>
					<?endif?>
				<?endif;?>
			<?endforeach?>
		</ul>
		<?foreach($arResult['SECTION'] as $key => $arSection):?>
			<?
				$this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
				$this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
		
			
			<div class="box" id="<?=$this->GetEditAreaId($arSect['ID']);?>">
				<?foreach($arSection['ELEMENTS'] as $arItems):?>
					<?
						$this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
				
						<div class="solution-files soft-grey title" id="#<?=$arItems['ID']?>">
							<h3><?=$arItems['NAME']?></h3>
						</div>
					
					
					<?if(!empty($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'])):?>	
<div class="twelve documents-info">
	<table style="width:100%">
						<?if($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']):?>
							<?foreach($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'] as $key => $arFiel):?>
								
			<tr>
				<td style="width:80%">
					<?if($arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][$key]):?>
					<?=$arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][$key]?>
					<?else:?>
					<?=$arFiel['ORIGINAL_NAME']?>
					<?endif;?>
				</td>
				<td width="100">
					<i><?=getFileExt($arFiel['SRC']);?>, <?=HumanBytes($arFiel['FILE_SIZE'])?></i>
				</td>
				<td width="50">
					<a href="/include/save_file.php?filename=<?=$arFiel['ID']?>"><div class="icons icon-download view"></div></a>				
				</td>
			</tr>

			<?/*
								<div class="solution-files">
									<div class="file-icon-1 icons"></div>
									<p>
									<?if($arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][$key]):?>
									<?=$arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][$key]?>
									<?else:?>
									<?=$arFiel['ORIGINAL_NAME']?>
									<?endif;?>
									</p>
									
									<a href="<?=$arFiel['SRC']?>"><?=GetMessage('CT_LOOK')?></a><a href="/include/save_file.php?filename=..<?=$arFiel['SRC']?>"><?=GetMessage('CT_DOWNLOAD')?></a>
									<b><?=$arFiel['CONTENT_TYPE']?>, <?=HumanBytes($arFiel['FILE_SIZE'])?></b>
								</div>
								*/?>
							<?endforeach?>

						<?else:?>

						<tr>
							<td style="width:80%">
								<?if($arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][0]):?>
									<?=$arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][0]?>
								<?else:?>
									<?=$arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['ORIGINAL_NAME']?>
								<?endif;?>
							</td>
							<td width="100">
								<i><?=getFileExt($arFiel['SRC']);?>, <?=HumanBytes($arFiel['FILE_SIZE'])?></i>
							</td>
							<td width="50">
								<a href="<?=$arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']?>"><div class="icons icon-download view"></div></a>				
							</td>
						</tr>

						<?/*?>
							<div class="solution-files">
								<div class="file-icon-1 icons"></div>
								<p>
									<?if($arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][0]):?>
										<?=$arItems['DISPLAY_PROPERTIES']['FILE']['DESCRIPTION'][0]?>
									<?else:?>
										<?=$arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['ORIGINAL_NAME']?>
									<?endif;?>
								</p>
								<a href=""><?=GetMessage('CT_LOOK')?></a><a href="/include/save_file.php?filename=..<?=$arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']?>"><?=GetMessage('CT_DOWNLOAD')?></a>
								<b><?=$arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['CONTENT_TYPE']?>, <?=HumanBytes($arItems['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['FILE_SIZE'])?></b>
							</div><?*/?>
						<?endif?>
							</table>						
						</div>

					<?endif?>
				<?endforeach?>				
			</div>
			
		<?endforeach?>
		<?else:?>
			Документ не найден
		<?endif;?>
	</div><!-- .section -->
</div>
