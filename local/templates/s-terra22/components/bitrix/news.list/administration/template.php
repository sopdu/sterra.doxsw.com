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
$this->setFrameMode(true);   //   echo "<pre>"; print_r($arResult); echo "</pre>";

use Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc;

?>
<div class="about-team__users">
	<? if(count($arResult["ITEMS"])): ?>
	<?foreach($arResult["ITEMS"] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="about-team-user" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="about-team-user__image">
				<? if(is_array($arItem["PREVIEW_PICTURE"])) { ?>
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
				<? } else { ?>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/about/about-user-placeholder.png" alt="">
				<? } ?>
			</div>
			<div class="about-team-user__name"><?=$arItem["NAME"]?></div>
			<div class="about-team-user__position"><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></div>
		</div>
	<? endforeach; ?>
	<? endif; ?>
</div>