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
$this->setFrameMode(true);                 //    echo "<pre>"; print_r($arResult); echo "</pre>";
?>

<div class="tab-body__item form-js" type="button" data-type="buisnes" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->NavPageSize?>" data-action="/local/ajax/partner-buisnes.php" data-method="GET">
    <div class="our-partners__list">
        <div class="our-partners__list-top">
            <div class="custom-select">
                <select class="js-select" name="region">
                    <option value="0">Все регионы</option>
                    <?
                    $regionsDB = CIBlockElement::GetList(
                        Array('PROPERTY_REGION_VALUE' => 'ASC'),
                        Array('IBLOCK_ID' => 15),
                        Array('PROPERTY_REGION')
                    );
                    while ($region = $regionsDB->Fetch()):
                    ?>
                        <option><?=$region['PROPERTY_REGION_VALUE']?></option>
                    <?endwhile;?>
                </select>
            </div>

            <div class="custom-select-modal" name="city">
                <div class="custom-select-modal-title start"><span>Все города</span></div>
                <div class="custom-select-modal__content" name="city">
                    <div class="custom-select-modal__content__close">
                        <svg width="20" height="20">
                            <use xlink:href="#i-close-custom" href="#i-close-custom"></use>
                        </svg>
                    </div>
                    <div class="custom-select-modal__content__top">
                        <div class="custom-select-modal__content__top-item active">Все</div>
                        <div class="custom-select-modal__content__top-item">А</div>
                        <div class="custom-select-modal__content__top-item">Б</div>
                        <div class="custom-select-modal__content__top-item">В</div>
                        <div class="custom-select-modal__content__top-item disabled">Г</div>
                        <div class="custom-select-modal__content__top-item disabled">Д</div>
                        <div class="custom-select-modal__content__top-item">Е</div>
                        <div class="custom-select-modal__content__top-item">Ж</div>
                        <div class="custom-select-modal__content__top-item disabled">З</div>
                        <div class="custom-select-modal__content__top-item">И</div>
                        <div class="custom-select-modal__content__top-item">Й</div>
                        <div class="custom-select-modal__content__top-item">К</div>
                        <div class="custom-select-modal__content__top-item">Л</div>
                        <div class="custom-select-modal__content__top-item">М</div>
                        <div class="custom-select-modal__content__top-item">Н</div>
                        <div class="custom-select-modal__content__top-item">О</div>
                        <div class="custom-select-modal__content__top-item">П</div>
                        <div class="custom-select-modal__content__top-item">Р</div>
                        <div class="custom-select-modal__content__top-item">С</div>
                        <div class="custom-select-modal__content__top-item">Т</div>
                        <div class="custom-select-modal__content__top-item">У</div>
                        <div class="custom-select-modal__content__top-item disabled">Ф</div>
                        <div class="custom-select-modal__content__top-item">Х</div>
                        <div class="custom-select-modal__content__top-item disabled">Ц</div>
                        <div class="custom-select-modal__content__top-item">Ч</div>
                        <div class="custom-select-modal__content__top-item disabled">Ш</div>
                        <div class="custom-select-modal__content__top-item disabled">Щ</div>
                        <div class="custom-select-modal__content__top-item disabled">Э</div>
                        <div class="custom-select-modal__content__top-item">Ю</div>
                        <div class="custom-select-modal__content__top-item">Я</div>
                    </div>
                    <div class="custom-select-modal__content__bottom" name="city">
                        <div class="custom-select-modal__content__bottom__wrap">
                            <div class="custom-select-modal__content__bottom__item bold">Москва</div>
                            <div class="custom-select-modal__content__bottom__item bold">Санкт-Петербург</div>
                            <?
                            $cityDB = CIBlockElement::GetList(
                                Array('PROPERTY_CITY_VALUE' => 'ASC'),
                                Array('IBLOCK_ID' => 15),
                                Array('PROPERTY_CITY')
                            );
                            while ($city = $cityDB->Fetch()):
                                if ($city == 'Москва' || $city == 'Санкт-Петербург') continue;
                            ?>
                                <div class="custom-select-modal__content__bottom__item"><?=$city['PROPERTY_CITY_VALUE']?></div>
                            <?endwhile;?>
                            <!--<div class="custom-select-modal__content__bottom__item">Астрахань</div>
                            <div class="custom-select-modal__content__bottom__item">Барнаул</div>
                            <div class="custom-select-modal__content__bottom__item">Белгород</div>
                            <div class="custom-select-modal__content__bottom__item">Владивосток</div>
                            <div class="custom-select-modal__content__bottom__item">Владимир</div>
                            <div class="custom-select-modal__content__bottom__item">Волгоград</div>
                            <div class="custom-select-modal__content__bottom__item">Вологда</div>
                            <div class="custom-select-modal__content__bottom__item">Воронеж</div>
                            <div class="custom-select-modal__content__bottom__item">Екатеринбург</div>
                            <div class="custom-select-modal__content__bottom__item">Железнодорожный</div>
                            <div class="custom-select-modal__content__bottom__item">Иркутск</div>
                            <div class="custom-select-modal__content__bottom__item">Йошкар-ола</div>
                            <div class="custom-select-modal__content__bottom__item">Казань</div>
                            <div class="custom-select-modal__content__bottom__item">Калининград</div>
                            <div class="custom-select-modal__content__bottom__item">Калуга</div>
                            <div class="custom-select-modal__content__bottom__item">Киров</div>
                            <div class="custom-select-modal__content__bottom__item">Королев</div>
                            <div class="custom-select-modal__content__bottom__item">Красногорск</div>
                            <div class="custom-select-modal__content__bottom__item">Краснодар</div>
                            <div class="custom-select-modal__content__bottom__item">Красноярск</div>
                            <div class="custom-select-modal__content__bottom__item">Курган</div>
                            <div class="custom-select-modal__content__bottom__item">Курск</div>
                            <div class="custom-select-modal__content__bottom__item">Липецк</div>
                            <div class="custom-select-modal__content__bottom__item">Нижневартовск</div>
                            <div class="custom-select-modal__content__bottom__item">Нижний Новгород</div>
                            <div class="custom-select-modal__content__bottom__item">Новокуйбышев</div>
                            <div class="custom-select-modal__content__bottom__item">Новосибирск</div>
                            <div class="custom-select-modal__content__bottom__item">Ноябрьск</div>
                            <div class="custom-select-modal__content__bottom__item">Омск</div>
                            <div class="custom-select-modal__content__bottom__item">Орел</div>
                            <div class="custom-select-modal__content__bottom__item">Пенза</div>
                            <div class="custom-select-modal__content__bottom__item">Пермь</div>
                            <div class="custom-select-modal__content__bottom__item">Петропавловск-Камчасткий</div>
                            <div class="custom-select-modal__content__bottom__item">Ростов-на-Дону</div>
                            <div class="custom-select-modal__content__bottom__item">Рыбинск</div>
                            <div class="custom-select-modal__content__bottom__item">Саратов</div>
                            <div class="custom-select-modal__content__bottom__item">Симферополь</div>
                            <div class="custom-select-modal__content__bottom__item">Сыктывкар</div>
                            <div class="custom-select-modal__content__bottom__item">Таганрог</div>
                            <div class="custom-select-modal__content__bottom__item">Тамбов</div>
                            <div class="custom-select-modal__content__bottom__item">Тверь</div>
                            <div class="custom-select-modal__content__bottom__item">Тольятти</div>
                            <div class="custom-select-modal__content__bottom__item">Томск</div>
                            <div class="custom-select-modal__content__bottom__item">Тула</div>
                            <div class="custom-select-modal__content__bottom__item">Тюмень</div>
                            <div class="custom-select-modal__content__bottom__item">Улан-Удэ</div>
                            <div class="custom-select-modal__content__bottom__item">Уфа</div>
                            <div class="custom-select-modal__content__bottom__item">Хабаровск</div>
                            <div class="custom-select-modal__content__bottom__item">Ханты-Мансийск</div>
                            <div class="custom-select-modal__content__bottom__item">Чебоксары</div>
                            <div class="custom-select-modal__content__bottom__item">Челябинск</div>
                            <div class="custom-select-modal__content__bottom__item">Юбилейный</div>
                            <div class="custom-select-modal__content__bottom__item">Южно-Сахалинск</div>
                            <div class="custom-select-modal__content__bottom__item">Ярославль</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-field js-input-search-field">
                <div class="search-field__icon">
                    <svg width="14" height="14">
                        <use xlink:href="#i-search" href="#i-search"></use>
                    </svg>
                </div>
                <input class="js-input-search form-control" value="" placeholder="Поиск" name="q" data-field autocomplete="off">
                <button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset>
                    <svg width="10" height="10">
                        <use xlink:href="#i-times" href="#i-times"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="our-partners__list__bottom js-body">
            <?foreach ($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
                ?>
                <div class="our-partners__list__bottom__item our-partners__list__bottom__item__long js-item">
                    <div class="our-partners__list__bottom__item_wrap">
                        <?if ($arItem["PROPERTIES"]["SITE_LINK"]["VALUE"]):?>
                        <a class="our-partners__list__bottom__item__title"  target="_blank" href="<?=$arItem["PROPERTIES"]["SITE_LINK"]["VALUE"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem["NAME"]?></a>
                        <?else:?>
                        <div class="our-partners__list__bottom__item__title disabled"  target="_blank" href="<?=$arItem["PROPERTIES"]["SITE_LINK"]["VALUE"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem["NAME"]?></div>
                        <?endif;?>
                        <div class="our-partners__list__bottom__item__city"><?=$arItem["PROPERTIES"]["CITY"]["VALUE"]?></div>
                        <div class="our-partners__list__bottom__item__area"><?=$arItem["PROPERTIES"]["REGION"]["VALUE"]?></div>
                    </div>
                </div>
            <?endforeach;?>
        </div>
        <div class="vacancies-vacant__controll js-control-text-support-documentation-3-show">
            <div class="vacancies-vacant__controll__text js-control-text js-control-text-support-documentation-3">Показано 24 из 274</div>
            <button class="js-control-more js-control-more-support-documentation-3 vacancies-vacant__controll__btn btn btn-primary-inverse">Еще 24</button>
        </div>
    </div>
</div>
