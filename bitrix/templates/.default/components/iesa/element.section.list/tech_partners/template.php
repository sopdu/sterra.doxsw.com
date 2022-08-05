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
<div class="twelve right awards">
	<h1><?=$APPLICATION->GetTitle();?></h1>


<div class="otstup"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
	)
);?></div>
	<div class="clearfix">
	</div>
	<div class="section">

 
	<?foreach($arResult['ITEMS'] as $arItems):?>
	
			<?
			if(intval($_REQUEST['region']) > 0) {
				if(!in_array($arItems['PROPERTIES']['CITY']['VALUE'], $arResult['CITY'][intval($_REQUEST['region'])]))
				 Continue;
			}
			?>
					
					
			<?if($arItems['PROPERTIES']['CITY']['VALUE'] == $_REQUEST['city'] ||  $_REQUEST['city'] == ""):?>
				<div class="twelve tabs-page conference">
					<div class="images left">
					<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
						<img class="left" src="<?=$arItems['PREVIEW_PICTURE']['SRC']?>" width="90" alt="#"/>
					<?endif?>
					</div>
					<div class="left conf-news lic">
						
						<span><?=$arItems['NAME']?></span>
						<div class="news">
							<i><?=$arItems['PROPERTIES']['CITY']['VALUE']?></i>,
							<i><?=$arItems['PROPERTIES']['REGION']['VALUE']?></i><br>
							<?=$arItems['~PREVIEW_TEXT']?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>			
			<?endif?>
			
	<?endforeach?>

	<div class="clearfix"></div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?//=$arResult["NAV_STRING"]?>
	<?endif?>
</div>
