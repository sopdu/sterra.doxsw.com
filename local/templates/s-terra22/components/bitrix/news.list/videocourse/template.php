<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this -> setFrameMode(true);
?>
<?
/*$rsResult = CIBlockElement::GetList(
    [],
    [
        'IBLOCK_ID' => 56,
        'ACTIVE' => 'Y',
        '!PROPERTY_VERSIA' => false,
    ],
    ['PROPERTY_versia']
);

while($arVerResult=$rsResult->Fetch()){
    $arVersions[] = $arVerResult["PROPERTY_VERSIA_VALUE"];
}*/


?>
<div class="container form-js" data-full-length="<?=$arResult['NAV_RESULT']->nSelectedCount?>" data-page-size="<?=$arResult['NAV_RESULT']->NavPageSize?>" data-action="/local/ajax/education-video.php" data-method="GET">
    <div class="support-education-page__top">
        <div class="support-education-page__title">Обучение</div>
        <ul class="support-education-page__filter">
            <li class="support-education-page__filter__item"><a class="support-education-page__filter__button" data-type="1" href="/support/education/courses/">Курсы</a></li>
            <li class="support-education-page__filter__item"><a class="support-education-page__filter__button active" data-type="2" href="/support/education/videouroki/">Видеоуроки</a></li>
        </ul>
    </div>
    <div class="support-education-page__control">
        <div class="custom-select">
            <select name="prodID" class="js-select version-filter">
                <option value="4.2" selected>Версия 4.2</option>
                <option value="4.1">Версия 4.1</option>
                <?/*
                $sections = CIBlockSection::GetList(
                    Array('SORT' => 'ASC'),
                    Array('IBLOCK_ID' => 7, 'DEPTH_LEVEL' => 3, '!UF_VIDEO' => false)
                );
                $sectionArr = Array();
                while ($section = $sections->Fetch()):
                */?><!--
                    <option value="<?/*=$section['ID']*/?>"><?/*=$section['NAME']*/?></option>
                --><?/*endwhile;*/?>
            </select>
        </div>
        <div class="search-field js-input-search-field">
            <div class="search-field__icon">
                <svg width="14" height="14">
                    <use xlink:href="#i-search" href="#i-search"></use>
                </svg>
            </div>
            <input class="js-input-search form-control" value="" placeholder="Поиск по названию" name="q" data-field autocomplete="off">

            <button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset>
                <svg width="10" height="10">
                    <use xlink:href="#i-times" href="#i-times"></use>
                </svg>
            </button>
        </div>
    </div>

<div class="support-education-page__content js-body">
			  <?foreach ($arResult["ITEMS"] as $arItem):
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
				?>
			  
            <div class="support-education-page__video js-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a class="support-education-page__video__item__wrap" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <div class="support-education-page__video__item-image"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
                <div class="support-education-page__video__item__title"><?=htmlspecialchars_decode($arItem["NAME"])?></div></a></div>
		<?endforeach;?>
</div>
<div class="vacancies-vacant__controll">
    <div class="vacancies-vacant__controll__text js-control-text"></div>
    <button class="js-control-more vacancies-vacant__controll__btn btn btn-primary-inverse"></button>
</div>

</div>