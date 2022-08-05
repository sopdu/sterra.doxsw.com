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
$this->setFrameMode(true);    //  echo "<pre>"; print_r($arResult); echo "</pre>";

use Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc;
$i = 0;

?>
		<div class="support-main-cards-wrap">
			<?foreach($arResult["ITEMS"] as $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$i++;
				?>
              <div class="support-main-card support-main-card-<?=$i?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="support-main-card-title"><?=$arItem["NAME"]?></div>
                <div class="support-main-card-wrap">
			<?foreach ($arItem["PROPERTIES"]["chto_vhodit"]["VALUE"] as $chto_vhodit):?>

                  <div class="support-main-card-item">
                    <svg class="check-icon support-main-card-item-icon">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#check-icon"></use>
                    </svg>
                    <div class="support-main-card-item-text"><?=$chto_vhodit?></div>
                  </div>
				<?endforeach;?>
                  <div class="support-main-card-footer">
					  <?if ($i == 1){?>
                    <div class="support-main-card-footer-text">1 год включен в стоимость продукта</div>
					  <?}else{?>
					<button class="btn support-main-card-footer-button" data-course-modal>Отправить запрос</button>
					  <?}?>
					</div>
                </div>
              </div>
			<?endforeach;?>