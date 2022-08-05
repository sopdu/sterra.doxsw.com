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

<div class="twelve right article ">
				<h1><?=$arResult['SECTION'][0]['NAME']?></h1>
				<div class="clearfix"></div>
				<p class="detail"><?=$arResult['SECTION'][0]['DESCRIPTION'] ?></p>
</div>				
<div class="twelve right">
	<div class="section">
	<br />
	<?if(count($arResult['ITEMS'])>0):?>
		<ul class="tabs">
			<?$i=1;?>
			<?foreach($arResult['ITEMS'] as $arItems):?>	
				<?if($arItems['PREVIEW_TEXT']):?>
					<li class="tab"><a href="#tab<?=$i?>"><b><?=$arItems['NAME']?></b></a></li>	
				<?endif?>
				<?$i++;?>
			<?endforeach?>
		</ul>
	
	<?foreach($arResult['ITEMS'] as $arItems):?>
			
		<div class="box">
			<div class="twelve">	
				<table class="about-product">
					<?if($arItems['PREVIEW_TEXT']):?>
						<tr>
							<!--<td><?=GetMessage('PR_DESC')?></td>-->
							<td class="about-product-apear"><?=$arItems['PREVIEW_TEXT']?></td>
						</tr>
					<?endif?>	
					<?if($arItems['DETAIL_TEXT']):?>
						<tr>
							<!--<td><?=GetMessage('PR_TECHNICAL')?></td>-->
							<td  class="about-product-apear"><?=$arItems['DETAIL_TEXT']?></td>
						</tr>
					<?endif?>	
					<?if($arItems['PROPERTIES']['MODEL']['VALUE']):?>
						<tr>
						
							<!--<td><?=GetMessage('PR_MODEL')?></td>-->
							<td>
							
							<?foreach($arItems['PROPERTIES']['MODEL']['ELEMENTS'] as $key => $arModels):?>	
								
								<div>
									<a class="open_text" href="#" ><?=$arModels['NAME']?></a><br />
									<div class="show" style="display: none"><?=$arModels['PREVIEW_TEXT']?>
										<br /><br />
									</div>
								</div>	
							<?endforeach?>
							</td>
						</tr>
					<?endif?>	
					<?if($arItems['PROPERTIES']['CERTIFICATION']['VALUE']):?>		
						<tr>
							<!--<td><?=GetMessage('PR_CERTIFICATION')?></td>-->
							<td>
							<?foreach($arItems['PROPERTIES']['CERTIFICATION']['ELEMENTS'] as $arCertif):?>	
								<div>		
									<a class="open_text_cer" href="#"><?=$arCertif['NAME']?></a><br />
									<div class="show_text" style="display: none"><?=$arCertif['PREVIEW_TEXT']?>
										<br /><br />
									</div>
								</div>
							<?endforeach?>	
							</td>
						</tr>
					<?endif?>			
				</table>							
			</div>	
			<?if(!empty($arItems['PROPERTIES']['DOCS_LINK']['VALUE'])):?>
				<div class="twelve">			
					<a href="<?=$arItems['PROPERTIES']['DOCS_LINK']['VALUE']?>" class="doc_button" target="_blank">
						<?=GetMessage('PR_DOCK')?><div class="icons icon-arrow-right-news"></div>
					</a>	
				</div>
			<?endif?>			
		</div>			
	<?endforeach?>
	<?endif;?>					
	</div>
</div>