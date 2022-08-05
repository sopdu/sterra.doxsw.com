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
<?foreach($arResult["SECTION"] as $arSect):?>
	<?
		$this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	
	
	<?foreach($arSect["ELEMENTS"] as $arElem):?>
		<?
		$this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="twelve tabs-page conference " id="<?=$this->GetEditAreaId($arElem['ID']);?>">
			<div class="images left">
			<?if(!empty($arElem['PREVIEW_PICTURE'])):?>
				<a class="fancybox" href="<?=$arElem['PREVIEW_PICTURE_BIG']['SRC']?>"><img class="left" src="<?=$arElem['PREVIEW_PICTURE']['src']?>" alt="#"/></a>
			<?endif?>
			</div>						
			<div class="left conf-news lic">
				
				<span><?=$arElem['NAME']?></span><br />
				<i>от <?=$arElem['PROPERTIES']['ACTIV_FROM']['VALUE']?> на "<?=$arElem['PROPERTIES']["PRODUCT"]["NAME"]?>"</i>
				<br />
				<p class="deistvo">Действителен до <?if(!empty($arElem['PROPERTIES']['ACTIV_TO']['VALUE']))  echo $arElem['PROPERTIES']['ACTIV_TO']['VALUE']; else echo "бессрочно";?></p>
				<div class='detail-text preview'><?=$arElem['PREVIEW_TEXT']?></div>
			</div>
			<div class="clearfix"></div>
		</div>
	<?endforeach;?>

<?endforeach?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

