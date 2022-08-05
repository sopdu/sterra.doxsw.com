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

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>" class="twelve right soft-blue doc-search">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<div class="bx_field">
			<input placeholder="<?echo $INPUT_ID?>" type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" autocomplete="off" class="bx_input_text"/>
			<?if($_REQUEST["q"]):?>
				<a href="<?=$arResult["FORM_ACTION"];?>"><div class="close_icons"></div></a>
			<?endif;?>
			<input class="blue right" type="submit" value="Найти">				
			<div class="round-button right icon-arrow-next"></div>
		</div>
	</form>
</div>
<?endif?>


