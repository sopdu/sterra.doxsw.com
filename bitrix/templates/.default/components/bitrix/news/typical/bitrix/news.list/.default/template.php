<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1>Типовые решения применения продуктов</h1>
	<div class="clearfix"></div>
	<div class="twelve right scenarios">
	<table>
	
	
		
		<?foreach($arResult['ITEMS'] as $key => $arItems):?>
			
		<?
			$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		<tr>
			<?if($key % 2 == 0):?>
					</tr>
		
					<tr>
			<?else:?>
			<td>
				<div class="three soft-grey scenario left" id="<?=$this->GetEditAreaId($arItems['ID']);?>">
					<div class="scenario-block">
						<div class="image-container">
						<?if(!empty($arItems['PICTURE']['SRC'])):?>
							<img src="<?=$arItems['PICTURE']['SRC']?>" alt="#"/>
						<?endif?>
						</div>
						<a href="<?=$arItems['SECTION_PAGE_URL']?>"><?=$arItems['NAME']?></a>
					</div>
				</div>		
			</td>
			<td>
				<div class="three soft-grey scenario left">
					<div class="scenario-block">
						<div class="image-container">
							<img src="<?=$arItems['PICTURE']['SRC']?>" alt="#"/>
						</div>
						<a href="<?=$arItems['SECTION_PAGE_URL']?>"><?=$arItems['NAME']?></a>
					</div>
				</div>								
			</td>
			<?endif?>	
		<?endforeach?>		
		
		</tr>
			
	</table>
	</div>				
</div>

<?$frame -> end();?>