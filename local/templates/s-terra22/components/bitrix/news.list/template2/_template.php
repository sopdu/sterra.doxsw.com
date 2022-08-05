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

$ruMonths = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
];

?>

            <div class="support-documentation-tab-1__top">
              <div class="support-documentation-tab-1__top__selects">
                <div class="custom-select">
                  <select>
                    <option value="0">Выбор версии</option>
                    <option>123</option>
                    <option>123</option>
                    <option>123</option>
                  </select>
                </div>
                <div class="custom-select">
                  <select>
                    <option value="0">Версия</option>
                    <?foreach($arResult["ITEMS"] as $arSectItem): //Цикл для вывода категорий?>
                    <option><?echo $arSectItem['NAME']?></option>
					<?endforeach;?>
                  </select>
                </div>
                <div class="custom-select">
                  <select>
                    <option value="0">Кем выдан</option>
                    <option>123</option>
                    <option>123</option>
                    <option>123</option>
                  </select>
                </div>
				</div><a class="btn btn-primary-inverse" href="/certificat.zip">
                <svg class="btn-icon desktop">
					<use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                </svg>
                <svg class="btn-icon mobile">
                  <use href="/local/templates/s-terra22/images/icon-sprite.svg#download-arrow-mobile"></use>
                </svg><span>Скачать все сертификаты</span></a>
            </div>
            <div class="support-documentation-tab-1__content">
			<? foreach($arResult['ITEMS'] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
			?>
              <div class="support-documentation-tab-1__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="support-documentation-tab-1__item__image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
                <div class="support-documentation-tab-1__item__text">
                  <div class="support-documentation-tab-1__item__text__title"><?=$arItem["NAME"]?></div>
                  <ul>
                    <li>На 
					<?foreach($arItem["PROPERTIES"]["PRODUCT"]["VALUE"] as $idel):?>
					<?$obj = CIBlockSection::GetByID($idel);?>
					<?if($objres = $obj->GetNext())?>
							<b><?=$objres["NAME"];?>,</b>
							<?endforeach;?>
						</li>
                    <li>От <?=$arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"]?></li>
                    <li>Криптография: <?=$arItem["PROPERTIES"]["CRIPTOGRAFY"]["VALUE"][0]?></li>
                    <li>Действителен до <?=$arItem["PROPERTIES"]["ACTIV_TO"]["VALUE"]?></li>
                  </ul>
                  <a target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["file"]["VALUE"]);?>" class="btn btn-primary-inverse">
                    <svg class="btn-icon desktop">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span>
                  </a>
                </div>
              </div>

	<?endforeach?>
            </div>
