<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="content kilo">
	<div class="title_kilo soft-blue">
		<h3><?=GetMessage('SOLUTION');?></h3>
	</div>	
	<div class="clearfix"></div>
		<section class="solutions">
		
			<?foreach($arResult['ITEMS'] as $key => $arItem):?>
				<?$arItem['NAME'] = explode(' ', $arItem['NAME']);?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>	
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="solution six">
							
							<?if(!empty($arItem["PROPERTIES"]['ACTION']['SRC']) || !empty($arItem["PROPERTIES"]['NO_ACTION']['SRC'])):?>
								<div class="icon ">
								
									<div class="icon-container">					
										<?if(!empty($arItem["PROPERTIES"]['ACTION']['SRC'])):?>
											<img src="<?=$arItem["PROPERTIES"]['ACTION']['SRC']?>" alt="#"/>
										<?endif?>
										<?if(!empty($arItem["PROPERTIES"]['NO_ACTION']['SRC'])):?>	
											<img src="<?=$arItem["PROPERTIES"]['NO_ACTION']['SRC']?>" alt="#"/>
										<?endif?>
									</div>
								</div>
							<?endif?>
							<p><?=$arItem['NAME'][0]?> <br /><?=$arItem['NAME'][1]?><br /> <?=$arItem['NAME'][2]?> <?=$arItem['NAME'][3]?> <?=$arItem['NAME'][4]?></p>
						</div>
					</a>
			<?endforeach?>
				<a href="resheniya/industry_solutions/">	
					<div class="allsolution six">
						<div><?=GetMessage('ALL_SOLUTION');?><div class="icon-arrow-right-news"></div></div>
					</div>
				</a>
		</section>				
</div>
	<div class="clearfix"></div>
			
<?$frame -> end();?>