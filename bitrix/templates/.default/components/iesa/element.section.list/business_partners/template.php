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


<br>
	<div class="clearfix">
	</div>
	<div class="section">
		<div class="twelve soft-blue doc-search">
			<form id="search-form">
				<?$APPLICATION->IncludeFile('/include/ajax/regions.php', array("type" => "business_partners"), array("MODE"=>"php"));?>
				
			</form>
		</div>

<br>
<table style="width: 100%;">
<tbody>
<tr>
<th style="width: 50%;" align="center"><strong>Наименование компании</strong></th>
<th style="width: 15%;" align="center"><strong>Город</strong></th>
<th style="width: 35%;" align="center"><strong>Федеральный округ</strong></th>
</tr>

	<?$a = 0;foreach($arResult['ITEMS'] as $arItems):?>
			<?
			if(intval($_REQUEST['region']) > 0) {
				if(!in_array($arItems['PROPERTIES']['CITY']['VALUE'], $arResult['CITY'][intval($_REQUEST['region'])]))
				 Continue;
			}
			?>

			<?if($arItems['PROPERTIES']['CITY']['VALUE'] == $_REQUEST['city'] ||  $_REQUEST['city'] == ""):?>
<? $a++; ?>

<tr>
<td><?if(!empty($arItems['PROPERTIES']['SITE_LINK']['VALUE'])):?><a href="<?=$arItems['PROPERTIES']['SITE_LINK']['VALUE']?>" target="_blank"><?=$arItems['NAME']?></a><?else:?><?=$arItems['NAME']?><?endif?></a></td>
<td><?=$arItems['PROPERTIES']['CITY']['VALUE']?></td>
<td><?=$arItems['PROPERTIES']['REGION']['VALUE']?></td>
</tr>

			<?endif?>
	<?endforeach?>

    <tbody>
</table>

		<?if($a == 0) { echo '<div class="news"><br><br><i>К сожалению, по вашему запросу партнёров не найдено</i></div>'; } ?>
	<div class="clearfix"></div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?//=$arResult["NAV_STRING"]?>
	<?endif?>
</div>
