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
<?/*
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

*/?>




<div class="support-documentation-tab-1 form-js" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->NavPageSize?>" data-action="/local/ajax/cert.php" data-method="GET">

    <!--/backend/support-1.json-->
    <div class="support-documentation-tab-1__top">
        <div class="support-documentation-tab-1__top__selects">
            <div class="custom-select">
                <select class="js-select" name="product">
                    <option value="">Выбор продукта</option>
                    <?

                    $productsIDs = [];
                    $productsID = CIBlockElement::GetList(
                        array(),
                        array('IBLOCK_ID' => 41, 'PROPERTY_PRODUCT' != false, 'ACTIVE' => 'Y'),
                        array('PROPERTY_PRODUCT')
                    );
                    while ($products = $productsID->Fetch()) if ($products['PROPERTY_PRODUCT_VALUE']) $productsIDs[] = $products['PROPERTY_PRODUCT_VALUE'];


                    if (count($productsIDs)):
                        $products = CIBlockSection::GetList(
                            Array('SORT' => 'ASC'),
                            Array('IBLOCK_ID' => 7, 'ID' => $productsIDs)
                        );
                        while ($product = $products->Fetch()):
                            ?>
                            <option value="<?=$product['ID']?>"><?=$product['NAME']?></option>
                        <?endwhile;endif; ?>
                </select>
            </div>

            <div class="custom-select">
                <select class="js-select" name="type">
                    <option value="">Кем выдан</option>
                    <?
                    $types = CIBlockElement::GetList(
                        array(),
                        array('IBLOCK_ID' => 41),
                        array('PROPERTY_TYPE')
                    );
                    while ($type = $types->Fetch()):
                        ?>
                        <option value="<?=$type['PROPERTY_TYPE_ENUM_ID']?>"><?=$type['PROPERTY_TYPE_VALUE']?></option>
                    <?endwhile;?>
                </select>
            </div>


        </div><a class="btn btn-primary-inverse" href="/certificat.zip">
            <svg class="btn-icon desktop">
                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
            </svg>
            <svg class="btn-icon mobile">
                <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
            </svg><span>Скачать все сертификаты</span></a>
    </div>

            <div class="support-documentation-tab-1__content js-body">
			<? foreach($arResult['ITEMS'] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
			?>
              <div class="support-documentation-tab-1__item js-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="support-documentation-tab-1__item__image my-gallery">
                    <figure>
                    <a class="big-img" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
                    </a>
                    </figure>
                </div>
                <div class="support-documentation-tab-1__item__text">
                  <div class="support-documentation-tab-1__item__text__title"><?=$arItem["NAME"]?></div>
                  <ul>
                    <li>На
                        <?
                        $first = true;
                        ?>
					<?foreach($arItem["PROPERTIES"]["PRODUCT"]["VALUE"] as $idel):?>
					<?$obj = CIBlockSection::GetByID($idel);?>
					<?if($objres = $obj->GetNext())?>
                            <?
                            if (!$first) $objres["NAME"] = ', '.$objres["NAME"];
                            else $first = false;
                            echo '<b>'.$objres["NAME"].'</b>';
							endforeach;?>
						</li>
                    <li>От <?=$arItem["PROPERTIES"]["ACTIV_FROM"]["VALUE"]?></li>
                    <li>Криптография: <?=$arItem["PROPERTIES"]["CRIPTOGRAFY"]["VALUE"][0]?></li>
                    <li>Действителен до <?=$arItem["PROPERTIES"]["ACTIV_TO"]["VALUE"]?></li>
                  </ul>

                  <a <?=$arItem["PROPERTIES"]["file"]["VALUE"] ? '' : 'style="opacity:0"'?> target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["file"]["VALUE"]);?>" class="btn btn-primary-inverse">
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
        <div class="vacancies-vacant__controll__text js-control-text js-control-text-support-documentation-3">Показано 24 из 274</div>
        <button class="js-control-more js-control-more-support-documentation-3 vacancies-vacant__controll__btn btn btn-primary-inverse">Еще 24</button>
    </div>
</div>
