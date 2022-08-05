<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<pre><?//print_r($arResult);?></pre>
<div class="twelve right">
<h1><?=$APPLICATION->GetTitle();?></h1>
		<div class="otstup">
	<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
			"AREA_FILE_SHOW" => "file",		
			"PATH" => "/products/catalog/index_inc.php", 
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
	</div>
	<div class="clearfix"></div>

		<div class="section">

			<ul class="tabs">
				<li class="current tab"><a href="#tab1"><b>Продуктовая линия</b></a></li>
				<li class="tab"><a href="#tab2"><b>Характеристики</b></a></li>
				<li class="tab"><a href="#tab3"><b>Назначение</b></a></li>
			</ul>

		
		<div class="box visible" style="display: block;" >
			<div class="twelve  soft-grey">	
				<table class="production">
					<tr>		
						<?foreach ($arResult['PRODUCT_LINES'] as $key => $line):?>
							<td>
								<p><?=$line['VALUE']?></p>
								<?foreach($arResult['SECTION'] as $arSections):?>	
									<?if($arSections['UF_PRODUCTS_LINE'] == $line['ID']):?>
										<a href="<?=$arSections['SECTION_PAGE_URL']?>"><?=$arSections['NAME']?></a>								
									<?endif?>
								<?endforeach?>	
							</td>
						<?endforeach;?>
					</tr>
				</table>							
			</div>	
					
		</div>
		<div class="box visible" style="display: none;">
		<div class="twelve">	
		<?/*
			<table class="parametrs">	
				<tr class="soft-grey">
					<td><p>Наименование</p></td>
					<td><p>Описание</p></td>
					<td><p>Сертификация</p></td>
				</tr>
				
				<?foreach($arResult['SECTION'] as $arSections):?>
					
					<tr>
						<td><a href="<?=$arSections['SECTION_PAGE_URL']?>"><?=$arSections['NAME']?></a></td>
						<td><?=$arSections['DESCRIPTION']?></td>
						<td>
						<?foreach($arSections['UF_CERTIFICATION'] as $items):?>
							<div>
								<p><?=$items['NAME']?></p><br />
								<div class="show_text" style="display: none"><?=$arCertif['PREVIEW_TEXT']?>
									<br /><br />
								</div>
							</div>	
						<?endforeach?>
						</td>
					</tr>
				<?endforeach?>
				
			</table>*/?>
			<div class="otstup">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
					"AREA_FILE_SHOW" => "file",		
					"PATH" => "/include/products_char.php",  
					"EDIT_TEMPLATE" => ""
					),
					false
				);?>
		</div>
			</div>
										
		</div>
		<div class="box visible" style="display: none;">
			<div class="twelve">
			<table class="parametrs target">	
				<tr class="soft-grey">
					<td><p>Наименование</p></td>
					<td><p>Корпоративная сеть</p></td>
					<td><p>Удаленный доступ</p></td>
					<td><p>Мобильный доступ</p></td>
					<td><p>ЦОД, СХД, высокопроиз-водительные каналы</p></td>
					<td><p>Виртуальная среда</p></td>
				</tr>
				<?foreach($arResult['SECTION'] as $arSections):?>
			
					<tr >
						<td><a href="<?=$arSections['SECTION_PAGE_URL']?>"><?=$arSections['NAME']?></a></td>

						<?if(in_array(1, $arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>
						
						<?if(in_array(2, $arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>
							
						<?if(in_array(3, $arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>
							
						<?if(in_array(4, $arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>
							
						<?if(in_array(5, $arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>
						
					</tr>
				<?endforeach?>	
			</table>	


		</div>
			
		</div>
			
</div><!-- .section -->
<div class="include" >
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/include/include_catalog_section.php",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
</div>
</div>