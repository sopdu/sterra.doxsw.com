<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right">
	
	<div class="clearfix"></div>
	<br />
	<!--<div class="twelve soft-blue doc-search">
		<form action="index.php" method="GET">
			<input type="text" placeholder="Поиск по документации"/>
			<input type="submit" value="Найти" class="blue right"/>
			<div class="round-button right icon-arrow-next"></div>
		</form>
	</div>-->
	<div class="clearfix"></div>
	<div class="twelve publication">
		<table>
			<thead>
				<tr class="soft-grey">
					<td><?=GetMessage('PU_DATE')?></td>
					<td><?=GetMessage('PU_NAME_PUB')?></td>
					<td><?=GetMessage('PU_AUTOR')?></td>
					<td><?=GetMessage('PU_SOURS')?></td>
					<td><?=GetMessage('PU_SEE')?></td>
					<td><?=GetMessage('PU_SAVE')?></td>
				</tr>
			</thead>	
			<tbody>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<tr>
					<td>
						<?if($arItem['PROPERTIES']['DATE']['VALUE']):?>
						<span class="date"><?=FormatDate("f Y", strtotime($arItem['PROPERTIES']['DATE']['VALUE']))?></span>
						<?endif;?>
					</td>
					<td>
						<p><?=$arItem['FIELDS']['NAME']?></p>
					</td>
					<td>
						<?=$arItem['PROPERTIES']['AUTOR']['VALUE']?>
					</td>
					<td>
						<?=$arItem['PROPERTIES']['SOURSE']['VALUE']?>
					</td>
					<td>
					<?if(!empty($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC'])):?>
						<a href="<?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['SRC']?>"><div class="icons icon-download eye"></div></a>
					<?endif?>
					</td>
					<td>
					<?if($arItem['PROPERTIES']['SAVE_FILE']['VALUE']):?>
						<a href="/include/save_file.php?filename=<?=$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['ID']?>"><div class="icons icon-download view"></div></a>
						<br />
						<i><?/*$arItem['PROPERTIES']['SAVE_FILE']['VALUE']['ORIGINAL_NAME']*/?> <?=HumanBytes($arItem['PROPERTIES']['SAVE_FILE']['VALUE']['FILE_SIZE'])?></i>					
					<?endif?>
					</td>
				</tr>
			<?endforeach?>	
			</tbody>
			
		</table>
		<br />						
		<?if(count($arResult["ITEMS"])==0):?>
			Документ не найден
		<?endif;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>

<?$frame -> end();?>