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
				<li class="current tab"><a href="#tab1"><b>Продуктовая линия </b></a></li>
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
                                                                        <?if (isset($arSections['CURRENT_VERSION'])):?>
                                                                                <?if ( ($arSections['CURRENT_VERSION']['UF_PRODUCTS_LINE'] == $line['ID'])):?>
                                                                                        <a href="<?=$arSections['CURRENT_VERSION']['SECTION_PAGE_URL']?>">
                                                                        			<?if ($arSections['CURRENT_VERSION']['IBLOCK_SECTION_ID'] == '148'):?>
																						<?=$arSections['CURRENT_VERSION']['NAME']?>
																					<? else :?>
																						<?=$arSections['NAME']?>
                                                                                <?endif?>
								</a>
                                                                                <?endif?>
                                                                        <? else :?>
                                                                                <?if(($arSections['UF_PRODUCTS_LINE'] == $line['ID'])):?>
	                                                                                <?if(($arSections['DEPTH_LEVEL'] == '1')):?>
                                                                                        <a href="<?=$arSections['SECTION_PAGE_URL']?>"><?=$arSections['NAME']?></a>
	                                                                                <?endif?>

	                                                                                <?if(($arSections['DEPTH_LEVEL'] == '3')):?>
<?foreach($arResult['SECTION'] as $arSections2):?>
	<?if(($arSections2['ID'] == $arSections['IBLOCK_SECTION_ID']) && ($arSections2['UF_CURRENT_VERSION'] == $arSections['ID'])):?>

                                                                                        <a href="<?=$arSections2['SECTION_PAGE_URL']?>"><?=$arSections2['NAME']?></a>
	                                                                                <?endif?>
<?endforeach?>	
	                                                                                <?endif?>
                                                                                <?endif?>
                                                                        <? endif ?>

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
<? unset($show_arSections); ?>

<? if (($arSections['DEPTH_LEVEL'] == "1") || ($arSections['DEPTH_LEVEL'] == '3')): ?>
	<? if (isset($arSections['CURRENT_VERSION'])){
		//$show_arSections = $arSections['CURRENT_VERSION'];
			if ($arSections['CURRENT_VERSION']['IBLOCK_SECTION_ID'] != '148'){
            	$show_arSections = $arSections['CURRENT_VERSION'];
            	$show_arSections['NAME'] = $arSections['NAME'];
			}
   		}else{
				//$show_arSections = $arSections;
	   		if(($arSections['DEPTH_LEVEL'] == '1')){
            	$show_arSections = $arSections;
	   		}
            if(($arSections['DEPTH_LEVEL'] == '3')){
		   		foreach($arResult['SECTION'] as $arSections2){
			   		if (($arSections2['ID'] == $arSections['IBLOCK_SECTION_ID']) && ($arSections2['UF_CURRENT_VERSION'] == $arSections['ID']) && $arSections2['DEPTH_LEVEL'] != '1'){
                   		$show_arSections = $arSections;

						$show_arSections['SECTION_PAGE_URL'] = $arSections2['SECTION_PAGE_URL'];
						$show_arSections['NAME'] = $arSections2['NAME'];
			   		}
				}
			}
   		}

                                        ?>

<? if (isset($show_arSections)): ?>
					<tr >
						<td><a href="<?=$show_arSections['SECTION_PAGE_URL']?>"><?=$show_arSections['NAME']?></a></td>

						<?if(in_array(1, $show_arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>

						<?if(in_array(2, $show_arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>

						<?if(in_array(3, $show_arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>

						<?if(in_array(4, $show_arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>

						<?if(in_array(5, $show_arSections['UF_NOMBRAMIENTOS'])):?>		
							<td><div class="icons icon-mark" ></div></td>
						<?else:?>
							<td><div></div></td>
						<?endif?>

					</tr>
<?endif?>
	<?endif?>
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