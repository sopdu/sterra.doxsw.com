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
<svg style="display: none;">
    <symbol id="i-locale" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 15" fill="none">
        <path d="M9.5 3.88889C9.5 3.12271 9.14179 2.38791 8.50416 1.84614C7.86654 1.30436 7.00174 1 6.1 1H1V11.8333H6.95C7.6263 11.8333 8.27491 12.0616 8.75312 12.4679C9.23134 12.8743 9.5 13.4254 9.5 14M9.5 3.88889C9.5 3.12271 9.85821 2.38791 10.4958 1.84614C11.1335 1.30436 11.9983 1 12.9 1H18V11.8333H12.05C11.3737 11.8333 10.7251 12.0616 10.2469 12.4679C9.76866 12.8743 9.5 13.4254 9.5 14M9.5 3.88889V8.58333V14" stroke="#7470E0" stroke-linecap="round" stroke-linejoin="round"/>
    </symbol>

    <symbol id="i-auth" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 18" fill="none">
        <path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" d="M8.50038 1.5C6.70548 1.5 5.25038 2.95508 5.25038 4.75C5.25038 6.54492 6.70548 8 8.50038 8C10.2953 8 11.7504 6.54492 11.7504 4.75C11.7504 2.95508 10.2953 1.5 8.50038 1.5ZM10.7816 8.33648C11.9653 7.58201 12.7504 6.25769 12.7504 4.75C12.7504 2.40279 10.8476 0.5 8.50038 0.5C6.1532 0.5 4.25038 2.40279 4.25038 4.75C4.25038 6.25769 5.03546 7.58201 6.21911 8.33648C3.81102 9.06474 1.85396 10.9161 0.858784 13.3075L0.853504 13.3202L0.408203 14.5815L0.695621 14.8025L0.697231 14.8037L0.700696 14.8064L0.71305 14.8158L0.758471 14.8499C0.797565 14.879 0.853869 14.9205 0.924298 14.9711C1.06494 15.0721 1.26303 15.2101 1.49367 15.3588C3.53862 16.6774 5.93646 17.4375 8.50038 17.4375C11.0643 17.4375 13.4621 16.6774 15.5071 15.3588C15.7377 15.2101 15.9358 15.0721 16.0765 14.9711C16.1469 14.9205 16.2032 14.879 16.2423 14.8499L16.2877 14.8158L16.3001 14.8064L16.3046 14.8029L16.5925 14.5815L16.1472 13.3202L16.142 13.3075C15.1468 10.9161 13.1897 9.06474 10.7816 8.33648ZM15.405 14.2216L15.2135 13.6792C14.0533 10.904 11.4714 9 8.50038 9C5.5293 9 2.94746 10.904 1.78725 13.6792L1.59577 14.2216C1.7159 14.3063 1.86649 14.4094 2.0356 14.5184C3.927 15.738 6.13799 16.4375 8.50038 16.4375C10.8628 16.4375 13.0737 15.738 14.9652 14.5184C15.1343 14.4094 15.2849 14.3063 15.405 14.2216Z" fill="#7470E0"/>
    </symbol>
</svg>


<div class="pressnews-page__content" data-iblock="<?=$arParams['IBLOCK_ID']?>" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->nSelectedCount->NavPageSize?>" data-action="/local/ajax/publ.php" data-method="GET">
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
            //if (!$arItem['PROPERTIES']['SAVE_FILE']['VALUE']) continue;
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

            $date = strtotime($arItem['ACTIVE_FROM']);
            ?>
            <div class="col col-12 col-sm-6 col-md-4">
                <a target="_blank" class="pressnews-page__item" href="<?=CFile::GetPath($arItem['PROPERTIES']['SAVE_FILE']['VALUE'])?>">
                    <div class="pressnews-page__item__date"><?=date('d', $date)?> <?=$ruMonths[date('n', $date)-1]?> <?=date('Y', $date)?></div>
                    <div class="pressnews-page__item__title"><?=$arItem['NAME']?></div>
                    <div class="pressnews-page__item__text"><?=$arItem['PREVIEW_TEXT']?></div>
                    <?if($arItem['PROPERTIES']['AUTOR']['VALUE']):?>
                    <div class="presspublic-page__item__auth">
                        <svg width="15" height="15">
                            <use xlink:href="#i-auth" href="#i-auth"></use>
                        </svg>
                        <div class="presspublic-page__item__text"><?=$arItem['PROPERTIES']['AUTOR']['VALUE']?></div>
                    </div>
                    <?endif;?>
                    <?if($arItem['PROPERTIES']['SOURSE']['VALUE']):?>
                    <div class="presspublic-page__item__locale">
                        <svg width="17" height="13">
                            <use xlink:href="#i-locale" href="#i-locale"></use>
                        </svg>
                        <div class="presspublic-page__item__text"><?=$arItem['PROPERTIES']['SOURSE']['VALUE']?></div>
                    </div>
                    <?endif;?>
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


