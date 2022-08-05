<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>
<h1><?=$APPLICATION->GetTitle();?></h1>
<div class="otstup">
		<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?>
	</div>

<div class="clearfix">

<section class="solutions">
		
	<?foreach($arResult['ITEMS'] as $key => $arItem):?>
		<?$arItem['NAME'] = explode(' ', $arItem['NAME']);?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>	

		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="solution four_alt">

				<?if(!empty($arItem["DISPLAY_PROPERTIES"]['ACTION']["FILE_VALUE"]['SRC']) || !empty($arItem["DISPLAY_PROPERTIES"]['NO_ACTION']["FILE_VALUE"]['SRC'])):?>
						<div class="icon ">
						
							<div class="icon-container">					
								<?if(!empty($arItem["DISPLAY_PROPERTIES"]['ACTION']["FILE_VALUE"]['SRC'])):?>
									<img src="<?=$arItem["DISPLAY_PROPERTIES"]['ACTION']["FILE_VALUE"]['SRC']?>" alt="#"/>
								<?endif?>
								<?if(!empty($arItem["DISPLAY_PROPERTIES"]['NO_ACTION']["FILE_VALUE"]['SRC'])):?>	
									<img src="<?=$arItem["DISPLAY_PROPERTIES"]['NO_ACTION']["FILE_VALUE"]['SRC']?>" alt="#"/>
								<?endif?>
							</div>
						</div>
					<?endif?>
				<p><?=$arItem['NAME'][0]?> <?=$arItem['NAME'][1]?><br /> <?=$arItem['NAME'][2]?> <?=$arItem['NAME'][3]?> <?=$arItem['NAME'][4]?></p>
			</div>
		</a>
		
	<?endforeach?>
	<?/*
		<a href="/resheniya/industry_solutions/" class="second_line">	
			<div class="allsolution four_alt">
				<div><?=GetMessage('ALL_SOLUTION');?><div class="icon-arrow-right-news"></div></div>
			</div>
		</a>
	*/?>
</section>	

<?$frame -> end();?>