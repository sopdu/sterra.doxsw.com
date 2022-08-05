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
		<div class="twelve new_twelve soft-blue doc-search">
			<form id="search-form">
				<?$APPLICATION->IncludeFile('/include/ajax/regions.php', array("type"=>"business_partners"), array("MODE"=>"php"));?>
			</form>
		</div>
		<ul class="tabs">
			<li class="current tab"><a href="#tab1"><b>
			<div class="icon icon-medal gold-medal">
			</div>
			Золотые партнеры</b></a></li>
			<li class="tab"><a href="#tab2"><b>
			<div class="icon icon-medal silv-medal">
			</div>
			Серебряные партнеры</b></a></li>
			<li class="tab"><a href="#tab3"><b>
			<div class="icon icon-medal coper-medal">
			</div>
			Бронзовые партнеры</b></a></li>
		</ul>
	
		<?foreach($arResult['SECTION'] as $key =>$arSection):?>
			<?if($key == 0):?>
				<div class="box visible">
			<?else:?>
				<div class="box">
			<?endif?>	
				<?
				$a = 0;
				foreach($arSection['ELEMENTS'] as $arItems):
				?>
					
					<?
					if(intval($_REQUEST['region']) > 0) {
						if(!in_array($arItems['PROPERTIES']['CITY']['VALUE'], $arResult['CITY'][intval($_REQUEST['region'])]))
						 Continue;
					}
					?>
					
					<?if($arItems['PROPERTIES']['CITY']['VALUE'] == $_REQUEST['city'] ||  $_REQUEST['city'] == ""):?>
						
						<? $a++; ?>
						<div class="twelve tabs-page conference">
							<div class="images left">
							<?if(!empty($arItems['PREVIEW_PICTURE'])):?>
								<img class="left" src="<?=$arItems['PREVIEW_PICTURE']['src']?>" alt="#"/>
							<?endif?>
							</div>						
							<div class="left conf-news lic">
								<span><?=$arItems['NAME']?></span><br>
								<i><?=$arItems['PROPERTIES']['CITY']['VALUE']?> ,</i> <i><?=$arItems['PROPERTIES']['REGION']['VALUE']?></i><br>
								<span><?=$arItems['PREVIEW_TEXT']?></span>
							</div>
							<div class="clearfix"></div>
						</div>			
					<?endif?>
				<?endforeach?>
				<?if($a == 0) { echo '<br />К сожалению, по вашему запросу партнёров не найдено'; } ?>
			<div class="clearfix"></div>
				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
					<?//=$arResult["NAV_STRING"]?>
				<?endif?>	
					
				<?if(!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) == 0) { ?><br /><br /><? ShowError('В данном разделе партнёров пока нет. Но обязательно будут позже! ');?><?}?>
			</div>
		<?endforeach?>
	</div>
</div>
	