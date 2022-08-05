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

use Bitrix\Main\Localization\Loc;
function getCount($filter){
    $el = CIBlockElement::GetList(
        Array('SORT' => 'ASC'),
        $filter,
        Array()
    );
    return $el;
}
?>
<div class="vacancies-vacant__title">Вакансии</div>
<div class="vacancies-vacant__top">
    <div class="vacancies-vacant__search">
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
    <?
    $arFilter = [ "IBLOCK_ID" => 4, "=ACTIVE" => "Y" ];
    $arFilter['PROPERTY_CITY'] = 41;
    $countZel = getCount($arFilter);
    $arFilter['PROPERTY_CITY'] = 40;
    $countMoscow = getCount($arFilter);

    if ($countZel && $countMoscow):
    ?>
    <ul class="vacancies-vacant__filter">
        <li class="vacancies-vacant__filter__item">
            <button class="js-control-item-button vacancies-vacant__filter__button active" data-type="" type="button">Все</button>
        </li>
        <?
        if ($countZel):
        ?>
        <li class="vacancies-vacant__filter__item">
            <button class="js-control-item-button vacancies-vacant__filter__button" data-type="1" type="button">Зеленоград</button>
        </li>
        <?endif;?>

        <?
        if ($countMoscow):
        ?>
        <li class="vacancies-vacant__filter__item">
            <button class="js-control-item-button vacancies-vacant__filter__button" data-type="2" type="button">Москва</button>
        </li>
        <?endif;?>

    </ul>
    <?endif;?>
</div>
<div class="vacancies-vacant__body row">
	<? if(count($arResult["ITEMS"])): ?>
		<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="js-item col col-12 col-sm-6 col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="vacancies-vacant__item" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="vacancies-vacant__item__subtitle"><?=$arItem["PROPERTIES"]["CITY"]["VALUE"][0].(isset($arItem['PROPERTIES']['CITY']['VALUE'][1]) ? " / ".$arItem['PROPERTIES']['CITY']['VALUE'][1] : "")?></div>
					<div class="vacancies-vacant__item__title"><?=$arItem["NAME"]?></div>
					<div class="vacancies-vacant__item__icon">
                        <?if($arItem["PROPERTIES"]["ICON"]["VALUE"]):?>
                            <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"])?>" alt="" class="vacancy-item">
                        <?endif?>
						<!--<svg width="58" height="44">
							<use xlink:href="#i-<?/*=$arItem["PROPERTIES"]["ICON"]["VALUE"]*/?>" href="#i-<?/*=$arItem["PROPERTIES"]["ICON"]["VALUE"]*/?>"></use>
						</svg>-->
					</div>
				</a>
			</div>
		<?endforeach;?>
	<? endif; ?>
</div>
