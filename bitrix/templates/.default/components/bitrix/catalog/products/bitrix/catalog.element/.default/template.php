<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<div class="twelve right article">
					<h1><?=$arResult['NAME']?></h1>
					<div class="clearfix"></div>
					<br />
				
					<br />

					<p><?=$arResult['PREVIEW_TEXT']?></p>
	</div>				
	<div class="twelve right">
	<div class="section">
	<br />

		<ul class="tabs">
		<?foreach($arResult['ITEMS'] as $key => $arItems):?>
			
			<?if($key == 0):?>
				<li class="current tab"><a href="#tab1"><b><?=$arItems['NAME']?></b></a></li>
			<?else:?>
				<li class="tab"><a href="#tab2"><b><?=$arItems['NAME']?></b></a></li></li>
			<?endif?>
			
		<?endforeach?>
		</ul>

	<?foreach($arResult['ITEMS'] as $key => $arItems):?>

	<?if($key == 0):?>	
	<div class="box visible">
			<div class="twelve">	
			<table class="about-product">
				<tr>
					<td><?=GetMessage('PR_DESC')?></td>
					<td class="about-product-apear"><?=$arItems['PREVIEW_TEXT']?></td>
				</tr>
				<tr>
					<td><?=GetMessage('PR_TECHNICAL')?></td>
					<td  class="about-product-apear"><?=$arItems['DETAIL_TEXT']?></td>
				</tr>
				<tr>
				
					<td><?=GetMessage('PR_MODEL')?></td>
					<td>
					
					<?foreach($arItems['PROPERTIES']['MODEL']['VALUE'] as $key => $arModels):?>	
							<a href="#" id="link_<?=$key?>"><?=$arModels['NAME']?></a><br />
							<div id="div_<?=$key?>" style="display: none"><?=$arModels['PREVIEW_TEXT']?>
							<br /><br />
							</div>	
							
							<script>	
								$("#link_<?=$key?>").click(function(){
									$("#div_<?=$key?>").slideToggle();
									return false;
								});
							</script>	
					<?endforeach?>
					</td>
				</tr>
				
				<tr>
					<td><?=GetMessage('PR_CERTIFICATION')?></td>
					<td>
					<?foreach($arItems['PROPERTIES']['CERTIFICATION']['VALUE'] as $arCertif):?>	
						<a href="<?=$arCertif['DETAIL_PAGE_URL']?>"><?=$arCertif['NAME']?></a><br />
					<?endforeach?>	
					</td>
				</tr>	
			</table>							
		</div>
		<?if(!empty($arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['DETAIL_PAGE_URL'])):?>
			<div class="twelve">			
				<a href="<?=$arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['DETAIL_PAGE_URL']?>#<?=$arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['ID']?>" class="doc_button">
					<?=GetMessage('PR_DOCK')?><div class="icons icon-arrow-right-news"></div>
				</a>	
			</div>
		<?endif?>
	</div>
	
	<?else:?>	
	
	<div class="box">
		<div class="twelve">	
			<table class="about-product">
				<tr>
					<td><?=GetMessage('PR_DESC')?></td>
					<td class="about-product-apear"><?=$arItems['PREVIEW_TEXT']?></td>
				</tr>
				<tr>
					<td><?=GetMessage('PR_TECHNICAL')?></td>
					<td><?=$arItems['DETAIL_TEXT']?></td>
				</tr>
				<tr>
				
					<td><?=GetMessage('PR_MODEL')?></td>
					<td>
					<?foreach($arItems['PROPERTIES']['MODEL']['VALUE'] as $arModels):?>
						<a href="#"><?=$arModels['NAME']?></a><br />
					<?endforeach?>
					</td>
				</tr>
				
				<tr>
					<td><?=GetMessage('PR_CERTIFICATION')?></td>
					<td>
					<?foreach($arItems['PROPERTIES']['CERTIFICATION']['VALUE'] as $arCertif):?>	
						<a href="<?=$arCertif['DETAIL_PAGE_URL']?>"><?=$arCertif['NAME']?></a><br />
					<?endforeach?>	
					</td>
				</tr>	
			</table>							
		</div>
		
		<?if(!empty($arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['DETAIL_PAGE_URL'])):?>
			<div class="twelve">	
				<a href="<?=$arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['DETAIL_PAGE_URL']?>#<?=$arResult['PROPERTIES']['DOCUMINTATION']['VALUE']['ID']?>" class="doc_button">
					<?=GetMessage('PR_DOCK')?><div class="icons icon-arrow-right-news"></div>
				</a>
			</div>
		<?endif?>	
	</div>
	<?endif?>
	
	<?endforeach?>

</div>
</div>