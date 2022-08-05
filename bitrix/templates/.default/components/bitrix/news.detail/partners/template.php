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

<?$this -> setFrameMode(true);?>

<?$frame = $this -> createFrame() -> begin();?>

<div class="twelve right article">
	<h1><?=$arResult['NAME']?></h1>
	<div style="overflow: hidden">
		<div class="otstup">
		<?if(!empty($arResult['PREVIEW_PICTURE']['src'])):?>
			<img src="<?=$arResult['PREVIEW_PICTURE']['src']?>" style="float: left; padding-right: 30px;" />
				
		<?endif?>	
		<?echo $arResult['PREVIEW_TEXT']?>
	</div>
</div>
	<div class="twelve">
		<a href="<?=$arResult['LIST_PAGE_URL']?>" class="doc_button"><?=GetMessage('BACK_TO_THE_LIST')?><div class="icons icon-arrow-right-news"></div></a>
	</div>
</div>

