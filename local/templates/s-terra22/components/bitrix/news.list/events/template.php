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

<svg style="display: none;" class="symbols">
    <symbol id="i-map" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" fill="none">
        <path d="M15.5 8C15.5 3.85786 12.1421 0.5 8 0.5C3.85786 0.5 0.5 3.85786 0.5 8C0.5 9.48045 0.928944 10.8607 1.66933 12.0233C3.24663 14.5 8 18.5 8 18.5C8 18.5 12.7534 14.5 14.3307 12.0233C15.0711 10.8607 15.5 9.48045 15.5 8Z" stroke="#7470E0"/>
        <circle cx="8" cy="8" r="3.5" stroke="#7470E0"/>
    </symbol>

    <symbol id="i-pc" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 17 17" fill="none">
        <path d="M0.5 1.5C0.5 0.947715 0.947715 0.5 1.5 0.5H15.5C16.0523 0.5 16.5 0.947715 16.5 1.5V10.5C16.5 11.0523 16.0523 11.5 15.5 11.5H1.5C0.947715 11.5 0.5 11.0523 0.5 10.5V1.5Z" stroke="#7470E0"/>
        <path d="M4.5 15.5C4.5 14.9477 4.94772 14.5 5.5 14.5H11.5C12.0523 14.5 12.5 14.9477 12.5 15.5C12.5 16.0523 12.0523 16.5 11.5 16.5H5.5C4.94772 16.5 4.5 16.0523 4.5 15.5Z" stroke="#7470E0"/>
        <path d="M6.5 11.5H10.5V14.5H6.5V11.5Z" stroke="#7470E0"/>
    </symbol>
</svg>

<div class="pressnews-page__content" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->nSelectedCount->NavPageSize?>" data-action="/local/ajax/events.php" data-method="GET">
    <div class="pressnews-page__content__top">
        <div class="pressnews-page__title">Пресс-центр</div>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/local/include/press-menu.php"
            )
        );
        ?>
    </div>
    <div class="pressnews-page__content__button row justify-content-between">
        <div class="pressnews-page__select col col-12 col-sm-4 col-md-3">
            <div class="pressnews-page__selected">
                <div class="pressnews-page__active">
                    <?if($_GET['filter_type'] && $_GET['filter_type'] != 'null') echo $_GET['filter_type'];
                    else echo 'За все время'?>
                </div>
                <div class="controlls <?if($_GET['filter_type'] && $_GET['filter_type'] != 'null') echo 'show'?>">
                    <button class="btn-primary-inverse close">
                        <svg width="10" height="10">
                            <use xlink:href="#i-times" href="#i-times"></use>
                        </svg>
                    </button>
                    <button class="btn-primary-inverse">
                        <svg width="10" height="10">
                            <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <ul class="pressnews-page__selects">
                <li class="js-control-item pressnews-page__select__item">
                    <button class="js-control-item-button pressnews-page__select_button" type="button" data-type="">За все время</button>
                </li>
                <?
                $yearsDB = CIBlockElement::GetList(
                    Array('ACTIVE_FROM' => 'ASC'),
                    Array('IBLOCK_ID' => $arParams['IBLOCK_ID']),
                    false,
                    Array('nPageSize' => 1),
                    Array('ACTIVE_FROM')
                );
                $yearItem = $yearsDB->Fetch();
                $yearEnd = date('Y', strtotime($yearItem['ACTIVE_FROM']));
                if (!$yearEnd) $yearEnd = 2019;
                $curYear = date('Y');
                while ($curYear >= $yearEnd):
                    ?>
                    <li class="js-control-item pressnews-page__select__item">
                        <button class="js-control-item-button pressnews-page__select_button <?if($_GET['filter_type'] == $curYear) echo 'active'?>" type="button" data-type="<?=$curYear?>"><?=$curYear?></button>
                    </li>
                    <?
                    $curYear--;
                endwhile;?>
            </ul>
        </div>
        <div class="pressnews-page__search col col-12 col-sm-7 col-md-8">
            <div class="search-field js-input-search-field">
                <div class="search-field__icon">
                    <svg width="14" height="14">
                        <use xlink:href="#i-search" href="#i-search"></use>
                    </svg>
                </div>
                <input class="js-input-search form-control" value="<?if($_GET['query'] && $_GET['query'] != 'null') echo $_GET['query']?>" placeholder="Поиск" name="q" data-field autocomplete="off">
                <button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset>
                    <svg width="10" height="10">
                        <use xlink:href="#i-times" href="#i-times"></use>
                    </svg>
                </button>
            </div>
            <ul class="search-list" data-list hidden></ul>
        </div>
    </div>




    <div class="pressnews-page__body row">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

            $dateFrom = strtotime($arItem['PROPERTIES']['FROM']['VALUE']);
            $dateTo = strtotime($arItem['PROPERTIES']['TO']['VALUE']);
            $dateText = '';

            if ($dateFrom){
                $dateText = date('d', $dateFrom).' '.$ruMonths[date('n', $dateFrom)-1];
                if (date('Y', $dateFrom) != date('Y', $dateTo)) $dateText.=' '.date('Y', $dateFrom);
                if ($dateTo) $dateText .= ' - '. date('d', $dateTo).' '.$ruMonths[date('n', $dateTo)-1].' '.date('Y', $dateTo);
            }

            if (!$arItem['PROPERTIES']['PLACE']['VALUE'] || $arItem['PROPERTIES']['PLACE']['VALUE'] == 'Он-лайн' || $arItem['PROPERTIES']['PLACE']['VALUE'] == 'Онлайн'){
                $icon = 'pc';
                $place = 'Онлайн';
            } else{
                $icon = 'map';
                $place = $arItem['PROPERTIES']['PLACE']['VALUE'];
            }
            ?>
            <div class="col col-12 col-sm-6 col-md-3">
                <a class="pressnews-page__item" href="<?=$arItem['DETAIL_PAGE_URL']?>">

                    <?if ($arItem['PREVIEW_PICTURE']['SRC']) $src = $arItem['PREVIEW_PICTURE']['SRC'];
                    else $src = SITE_TEMPLATE_PATH.'/images/pressnews/no-img.svg'?>
                    <div class="pressnews-page__item__image" style="background-image: url('<?=$src?>');"></div>

                    <div class="pressnews-page__item__date"><?=$dateText?></div>
                    <div class="pressnews-page__item__title"><?=$arItem['NAME']?></div>
                    <div class="pressevent-page__item__locale">
                        <svg width="10" height="10">
                            <use xlink:href="#i-<?=$icon?>" href="#i-<?=$icon?>"></use>
                        </svg>
                        <div class="pressevent-page__item__text"><?=$place?></div>
                    </div>
                    <div class="pressnews-page__item__text"><?=$arItem['PREVIEW_TEXT']?></div>
                </a>
            </div>
        <?endforeach;?>
    </div>


    <div class="pressnews-page__controll">
        <div class="pressnews-page__controll__text js-control-text">Показано <?=$arResult['NavPageSize']?> из <?=$arResult['nSelectedCount']?></div>
        <button class="js-control-more pressnews-page__controll__btn btn btn-primary-inverse">Еще 12</button>
    </div>



    <div class="pressnews-page__contacts">
        <div class="pressnews-page__contacts__title">Контакты отдела PR и рекламы</div>
        <?
        $APPLICATION->IncludeComponent(
        	"bitrix:main.include",
        	"",
        	Array(
        		"AREA_FILE_SHOW" => "file",
        		"AREA_FILE_SUFFIX" => "inc",
        		"EDIT_TEMPLATE" => "",
        		"PATH" => "/local/include/phone.php"
        	)
        );
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/local/include/email.php"
            )
        );
        ?>
    </div>
</div>


