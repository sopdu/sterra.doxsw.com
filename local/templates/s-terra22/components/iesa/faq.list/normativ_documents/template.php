<div class="twelve right">
					
	<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
					<div class="clearfix"></div>
					<br />
<!-- 				<div class="twelve soft-blue doc-search">
						<form action="index.php" method="GET">
							<input type="text" placeholder="Поиск по документации"/>
							<input type="submit" value="Найти" class="blue right"/>
							<div class="round-button right icon-arrow-next"></div>
						</form>
					</div>	 -->
	<div class="clearfix"></div>
	<div class="twelve documents-info">
		<table>
			<thead>
				<tr class="soft-grey">
					<td><?=GetMessage('CT_NUMBER_AND_DATE')?></td>
					<td><?=GetMessage('CT_NAME_DOCUMENT')?></td>
					<td><?=GetMessage('CT_DESCKRIPTION')?></td>
					<td><?=GetMessage('CT_LOOK')?></td>
					<td><?=GetMessage('CT_SAVE')?></td>
				</tr>
			</thead>	
			<tbody>
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<tr>
					<td>
						<p class="black"><?=$arItem['PROPERTIES']['NUMBER']['VALUE']?></p>
						<p class='gray'><?=substr($arItem['ACTIVE_FROM'], 0 , 10)?></p>
					</td>
					<td class="black">
						<?=$arItem['NAME']?>
					</td>
					<td class='table__preview-text'>
						<?=$arItem['PREVIEW_TEXT']?>
					</td>
					<td>
						<a href="<?=$arItem['PROPERTIES']['FILE']['VALUE']['SRC']?>"><div class="icons icon-download eye"></div></a>
					</td>
					<td>
						<a href="/include/save_file.php?filename=<?=$arItem['PROPERTIES']['FILE']['VALUE']['ID']?>"><div class="icons icon-download view">
							<?//print_r($arItem['PROPERTIES']['FILE']['VALUE'])?></div></a>
						<br />
						
						<i>
							<?=getFileExt($arItem['PROPERTIES']['FILE']['VALUE']['FILE_NAME']);?>, <?=$arItem['PROPERTIES']['FILE']['VALUE']['FILE_SIZE']?></i>
					</td>
				</tr>
			<?endforeach?>	
				
			</tbody>
			
		</table>
<br />
		<?if(count($arResult['ITEMS'])==0):?>
			Документ не найден
		<?endif;?>

	</div>
	
</div>