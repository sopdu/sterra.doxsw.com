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

<?
$productsIDs = [];
$productsID = CIBlockElement::GetList(
    Array(),
    Array('IBLOCK_ID' => 54, 'PROPERTY_PRODUCT' != false),
    Array('PROPERTY_PRODUCT')
);
while ($products = $productsID->Fetch()) if ($products['PROPERTY_PRODUCT_VALUE']) $productsIDs[] = $products['PROPERTY_PRODUCT_VALUE'];
?>
            <div class="support-documentation-tab-3 form-js" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->NavPageSize?>" data-action="/local/ajax/svid.php" data-method="GET">
            <div class="support-documentation-tab-3__top">

                <div class="custom-select">
                    <select class="js-select" name="product">
                        <option value="">Выбор продукта</option>
                        <?
                        if (count($productsIDs)):
                            $products = CIBlockSection::GetList(
                                Array('NAME' => 'ASC'),
                                Array('IBLOCK_ID' => 7, 'ID' => $productsIDs)
                            );
                            while ($product = $products->Fetch()):
                                ?>
                                <option value="<?=$product['ID']?>"><?=$product['NAME']?></option>
                            <?endwhile;endif; ?>
                    </select>
                </div>

				<a href="/svidetelstva.zip" class="btn btn-primary-inverse">
                <svg class="btn-icon">
					<use href="/local/templates/s-terra22/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
                </svg>
                <!--<svg class="btn-icon mobile">
                  <use href="/local/templates/s-terra22/images/icon-sprite.svg#download-arrow-mobile"></use>
                </svg>-->
                    <span>Скачать все свидетельства</span></a>
            </div>
            <div class="support-documentation-tab-3__content js-body">
			<? foreach($arResult['ITEMS'] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
			?>
              <div class="support-documentation-tab-3__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="support-documentation-tab-3__item__image my-gallery">
                    <figure>
                        <a class="big-img" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                        </a>
                    </figure>
                    <!--<img src="<?/*=$arItem["PREVIEW_PICTURE"]["SRC"]*/?>">-->
                </div>
                <div class="support-documentation-tab-3__item__text">
                  <div class="support-documentation-tab-3__item__text__title"><?=$arItem["NAME"]?></div>
                    <div class="support-documentation-tab-3__item__text__subtitle"><?=$arItem["PROPERTIES"]["TYPE"]["VALUE"]?></div>
                    <div class="support-documentation-tab-3__item__text__description">
                        <?//=$arItem["PREVIEW_TEXT"]?>
                        <ul>
                            <?
                            if($arItem['PROPERTIES']['PRODUCT']['VALUE']):
                            $prodDB = CIBlockSection::GetList(
                                Array('SORT' => 'ASC'),
                                Array('ID' => $arItem['PROPERTIES']['PRODUCT']['VALUE'], 'IBLOCK_ID' => 7),
                                false,
                                Array('NAME')
                            );
                            $prod = $prodDB->Fetch();
                            ?>
                            <li><b><?=$prod['NAME']?></b></li>
                            <?endif?>
                            <?if($arItem['ACTIVE_FROM']):?>
                            <li>От <?=$arItem['ACTIVE_FROM']?></li>
                            <?endif?>
                        </ul>
                    </div>
					<a target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]);?>" class="btn btn-primary-inverse">
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
            <div class="vacancies-vacant__controll js-control-text-support-documentation-3-show">
                <div class="vacancies-vacant__controll__text js-control-text js-control-text-support-documentation-3"></div>
                <button class="js-control-more js-control-more-support-documentation-3 vacancies-vacant__controll__btn btn btn-primary-inverse"></button>
            </div>
</div>