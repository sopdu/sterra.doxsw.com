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

$active = true;
?><div class="jumbotron">
          <div class="container">
            <div class="home-banner">
			<?foreach($arResult["ITEMS"] as $arItem):
							$but_text = $arItem["PROPERTIES"]["BUTTON"]["VALUE"];
							if(!$but_text) {
								$but_text = "Подробнее";
							}
							$active_text = "";
							if($active) {
								$active_text = " active";
								$active = false;
							}
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
              <div class="home-banner__content">
                <div class="home-banner__text"><?=$arItem["NAME"]?></div>
                <div class="home-banner__description">
                 <?=$arItem["DETAIL_TEXT"]?>
                </div>
                <div class="home-banner-buttons"><a class="btn btn-accent" href="" download>
                    <svg class="btn-icon desktop">
                      <use href="./img/icons/icon-sprite.svg#user"></use>
                    </svg>
                    <svg class="btn-icon mobile" style="fill: #7470E0;">
                      <use href="./img/icons/icon-sprite.svg#user-mobile"></use>
                    </svg><span>Войти в личный кабинет</span></a><a class="btn btn-white" data-course-modal><span class="desktop">Написать в техподдержку</span><span class="mobile">Написать в поддержку</span></a></div>
              </div>
              <div class="home-banner__img"><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt=""></div>
<?endforeach;?>
            </div>
          </div>
        </div>