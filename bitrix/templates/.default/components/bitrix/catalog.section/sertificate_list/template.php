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

if (!empty($arResult['ITEMS']))
{?>

<?
$types = array();
foreach ($arResult['ITEMS'] as $key => $arItem) {
	$types[$arItem['PROPERTIES']['TYPE']['VALUE']][] = $arItem;
}
?>

<?foreach ($types as $typeName => $arItems):?>
<div class="codabra-cert-type-wrapper">
<div class="codabra-cert-type"><strong><?= $typeName?></strong></div>
	<?foreach ($arItems as $key => $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);?>

		<div class="twelve tabs-page conference cert-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="images left">
			<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
				<a class="fancybox" href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"><img class="left" src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="#"/></a>
			<?endif?>
			</div>
			<div class="left conf-news lic">
				<?
				$ids = array();
				$names = array();
				if (!empty($arItem["DISPLAY_PROPERTIES"]['PRODUCT']['LINK_SECTION_VALUE'])) {
					foreach ($arItem["DISPLAY_PROPERTIES"]['PRODUCT']['LINK_SECTION_VALUE'] as $id => $item) {
						$ids[] = $id;
						$names[] = $item['NAME'];
					}
					$strIds = implode('|', $ids);
					$strNames = implode('|', $names);
					$strNamesCommaSeparated = implode(', ', $names);
				}
				?>
				<span class="cert-name" data-product-ids="<?=$strIds?>" data-product-names="<?=$strNames?>"><?=$arItem['NAME']?></span><br />
				<i>от <?=Date("d.m.Y",strtotime($arItem['PROPERTIES']['ACTIV_FROM']["VALUE"]));?></i>
				<?if(!empty($names)):?>
				<p style="padding-bottom:7px; padding-top:7px;"><i>на <?=$strNamesCommaSeparated?>
				<?endif?>
				</i></p>

				<?if(!empty($arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE'])):?>
				<?
				if (is_array($arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE'])) {
					$cryptTypeData = implode(',', $arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE']);
					$cryptType = implode(', ', $arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE']);
				} else {
					$cryptTypeData = $arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE'];
					$cryptType = $arItem['PROPERTIES']['CRIPTOGRAFY']['VALUE'];
				}
				?>
				<p>Криптография: <strong class="crypt-type" data-crypt-type="<?=$cryptTypeData?>" ><?=$cryptType?></strong></p>
				<?else:?>
					<p>Криптография: <strong class="crypt-type" data-crypt-type="No-Crypt" > --- </strong></p>
				<?endif?>

				<p class="deistvo">Действителен до <?if(!empty($arItem['PROPERTIES']['ACTIV_TO']['VALUE']))  echo Date("d.m.Y",strtotime($arItem['PROPERTIES']['ACTIV_TO']["VALUE"])); else echo "бессрочно";?></p>
				<div class='detail-text preview'><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
			<div class="clearfix"></div>
		</div>
	<?endforeach;?>
</div>
<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?}?>
