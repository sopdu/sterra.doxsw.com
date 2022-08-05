<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this -> setFrameMode(true);?>
<div class="support-education-page__content">
			  <?foreach ($arResult["ITEMS"] as $arItem):
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
				?>
			  
            <div class="support-education-page__video" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a class="support-education-page__video__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <div class="support-education-page__video__item-image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
                <div class="support-education-page__video__item__title"><?=$arItem["NAME"]?></div></a></div>
		<?endforeach;?>
</div>
