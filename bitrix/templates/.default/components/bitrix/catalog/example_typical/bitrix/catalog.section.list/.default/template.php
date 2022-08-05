<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="twelve right article">
	<h1><?=$APPLICATION->GetTitle();?></h1>

<div class="otstup"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?></div>
	<div class="clearfix"></div>
	<div class="twelve right scenarios">
	<table class='no-border'>
		<?foreach($arResult['SECTIONS'] as $key => $arItems):?>

		<?
			$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		<?if($key % 2 == 0):?>
				
	
				<tr>
		<?endif?>
			<td>
				<div class="three soft-grey scenario left lift" id="<?=$this->GetEditAreaId($arItems['ID']);?>">
					<div class="scenario-block">
						<div class="image-container">
						<?if(!empty($arItems['PICTURE']['SRC'])):?>
							<a href="<?=$arItems['SECTION_PAGE_URL']?>"><img src="<?=$arItems['PICTURE']['SRC']?>" alt="#"/></a>
						<?endif?>
						</div >
						<div class="divi">
						<a href="<?=$arItems['SECTION_PAGE_URL']?>"><?=$arItems['NAME']?></a>
						</div>
					</div>
				</div>		
			</td>	
		<?endforeach?>		
		
		</tr>
			
	</table>
	</div>				
</div>
