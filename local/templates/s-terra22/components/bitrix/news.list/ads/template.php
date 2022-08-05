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



<div class="pressnews-page__content" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->nSelectedCount->NavPageSize?>" data-action="/local/ajax/news.php" data-method="GET">
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
                <div class="pressnews-page__active">За все время</div>
                <div class="controlls">
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
                $yearEnd = 2019;
                $curYear = date('Y');
                while ($curYear >= $yearEnd):
                ?>
                <li class="js-control-item pressnews-page__select__item">
                    <button class="js-control-item-button pressnews-page__select_button" type="button" data-type="<?=$curYear?>"><?=$curYear?></button>
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
                <input class="js-input-search form-control" value="" placeholder="Поиск" name="q" data-field autocomplete="off">
                <button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset>
                    <svg width="10" height="10">
                        <use xlink:href="#i-times" href="#i-times"></use>
                    </svg>
                </button>
            </div>
            <ul class="search-list" data-list hidden></ul>
        </div>
    </div>




    <div class="pressnews-page__body row1123">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

            $date = strtotime($arItem['ACTIVE_FROM']);

            echo "<pre>";
            print_r($arItem);
            echo "</pre>";

            if ($arItem['PROPERTIES']['ADS_LINK']['VALUE']) $url = $arItem['PROPERTIES']['ADS_LINK']['VALUE'];
            else $url = $arItem['DETAIL_PAGE_URL'];

            ?>
            <div class="col col-12 col-sm-6 col-md-3">
                <a class="pressnews-page__item" href="<?=$url?>">
                    <img class="pressnews-page__item__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                    <div class="pressnews-page__item__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                    <div class="pressnews-page__item__title"><?=$arItem['NAME']?></div>
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


