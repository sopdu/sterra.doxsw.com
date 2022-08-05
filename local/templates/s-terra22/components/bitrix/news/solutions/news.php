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

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if( $arResult["FOLDER"] == "/catalog/complex_solutions/" ) {
	$IBLOCK_ID = 18;
	$ajax = "catalog-compl-item.php";
	$pageSize = 9;
}
elseif( $arResult["FOLDER"] == "/resheniya/industry_solutions/" ) {
	$IBLOCK_ID = 46;
	$ajax = "catalog-ind-item.php";
	$pageSize = 9;
}

$arFilter = [ "IBLOCK_ID" => $IBLOCK_ID, "=ACTIVE" => "Y" ];
$count = \Bitrix\Iblock\ElementTable::getCount($arFilter);
?>
<div class="catalog-compl-page">
	<main class="page-main">
		<div class="bg-block">
			<div class="catalog-compl-page__jumbotron"><!-- JUMBOTRON -->
				<div class="jumbotron">
					<div class="container">
						<div class="home-banner">
							<div class="home-banner__content">
								<div class="home-banner__text">Решения компании «С-Терра СиЭсПи»</div>
								<div class="home-banner__description">
									<ul>
										<li>Органично интегрируются в существующую информационную инфраструктуру</li>
										<li>Помогают реализовать новую современную систему защиты</li>
										<li>Применяются в соответствии с отраслевыми стандартами и требованиями по защите информации</li>
									</ul>
								</div>
                                <?
                                $catalogDB = CIBlockElement::GetList(
                                    Array('SORT' => 'ASC'),
                                    Array('IBLOCK_ID' => 67),
                                    false,
                                    false,
                                    Array('PROPERTY_FILE')
                                );
                                $catalogItem = $catalogDB->Fetch();
                                ?>
                                <?if($catalogItem['PROPERTY_FILE_VALUE']):?>
                                    <a class="btn btn-accent" href="<?=CFile::GetPath($catalogItem['PROPERTY_FILE_VALUE'])?>" download>
                                        <svg class="btn-icon">
                                            <use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow"></use>
                                        </svg>
                                        <span>Каталог продукции</span>
                                    </a>
                                <?endif;?>
							</div>
							<div class="home-banner__img"><img src="<?=SITE_TEMPLATE_PATH?>/images/catalog/compl/banner.png" alt=""></div>
						</div>
					</div>
				</div><!-- /JUMBOTRON -->
			</div>
		</div>
	</main>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
			"START_FROM" => "1",
			"PATH" => "",
			"SITE_ID" => SITE_ID,
		),
		false
	);

	?>
	<div class="catalog-block">
		<div class="container">
			<div id="content" class="catalog-block__content js-catalog" data-full-length="<?=$count?>" data-page-size="<?=$pageSize?>" data-page-size-mobile="5" data-action="/local/ajax/<?=$ajax?>" data-method="GET">
				<div class="catalog-block__top">
					<div class="catalog-block__title">Каталог</div>
					<ul class="catalog-block__filter">
						<li class="catalog-block__filter__item"><a class="catalog-block__filter__button" data-type="" href="/products/catalog/#content">Продукты</a></li>
						<li class="catalog-block__filter__item"><a class="catalog-block__filter__button<?=($IBLOCK_ID==18 ? " active" : "")?>" data-type="1" href="/catalog/complex_solutions/#content">Комплексные решения</a></li>
						<li class="catalog-block__filter__item"><a class="catalog-block__filter__button<?=($IBLOCK_ID==46 ? " active" : "")?>" data-type="2" href="/resheniya/industry_solutions/#content">Отраслевые решения</a></li>
					</ul>
				</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"solutions",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PREVIEW_PICTURE" => $arParams["DISPLAY_PREVIEW_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
	),
	$component
);?>
				<div class="catalog-block__controll">
					<div class="catalog-block__controll__text js-control-text"></div>
					<button class="js-control-more catalog-block__controll__btn btn btn-primary-inverse"></button>
				</div>
			</div>
		</div>
	</div>
	<div class="catalog-compl-sertificates">
		<div class="catalog-compl-sertificates__wrap">
			<div class="catalog-compl-sertificates__title">Наши сертификаты</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"cert_slider",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_PICTURE",
						2 => "DETAIL_PICTURE",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "41",
					"IBLOCK_TYPE" => "products",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "20",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "PRODUCT",
						1 => "ACTIV_FROM",
						2 => "ACTIV_TO",
						3 => "CRIPTOGRAFY",
						4 => "TYPE",
						5 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "DESC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "cert_slider"
				),
				false
			);?>
			<div class="catalog-compl-sertificates-slider__control js-slider-control-1">
				<button class="btn btn-primary-inverse btn-round" data-controls="prev">
					<svg width="7" height="12">
						<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
					</svg>
				</button>
				<button class="btn btn-primary-inverse btn-round" data-controls="next">
					<svg width="7" height="12">
						<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
					</svg>
				</button><a class="btn btn-primary-inverse" href="/support/documentation/certificates/">Все сертификаты</a>
			</div>
		</div>
	</div>
	<div class="catalog-description-block">
		<div class="catalog-description-block__wrap">
			<div class="catalog-description-block__title">Преимущества продуктов и решений  С‑Терра</div>
			<div class="catalog-description-block__description">Построение защищенных соединений, межсетевое экранирование, поддержка современных сетевых протоколов, соответствие требованиям регуляторов ИБ позволяет органично интегрировать решения и продукты С-Терра в существующую корпоративную сеть</div>
			<div class="catalog-description-block__items">
				<div class="catalog-description-block__items_col">
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="55" height="50">
								<use xlink:href="#i-teges-1" href="#i-teges-1"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Легкая интеграция в инфраструктуру сети</div>
					</div>
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="58" height="46">
								<use xlink:href="#i-teges-3" href="#i-teges-3"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Сертификация ФСБ и ФСТЭК России</div>
					</div>
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="56" height="51">
								<use xlink:href="#i-teges-5" href="#i-teges-5"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Продукты в Реестре российского ПО</div>
					</div>
				</div>
				<div class="catalog-description-block__items_col">
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="60" height="44">
								<use xlink:href="#i-teges-2" href="#i-teges-2"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Сisco-like интерфейс понятен каждому инженеру</div>
					</div>
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="69" height="44">
								<use xlink:href="#i-teges-4" href="#i-teges-4"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Стандартный протокол IPsec</div>
					</div>
					<div class="catalog-description-block__item">
						<div class="catalog-description-block__item-icon">
							<svg width="63" height="51">
								<use xlink:href="#i-teges-6" href="#i-teges-6"></use>
							</svg>
						</div>
						<div class="catalog-description-block__item-text">Бесплатная техподдержка в первый год</div>
					</div>
				</div>
			</div>
			<div class="catalog-description-block__subtitle">Продукты С-Терра включены в «Единый реестр российских программ для ЭВМ и баз данных»</div>
			<div class="catalog-description-block__description catalog-description-block__description__small">Они могут использоваться как в государственных учреждениях, так и в коммерческих организациях в соответствии с отраслевыми стандартами и требованиями по защите информации:</div>
			<div class="catalog-description-block__lists">
				<ul class="catalog-description-block__list">
					<li>конфиденциальной информации</li>
					<li>подключения информационных систем государственных органов к Интернет</li>
					<li>персональных данных</li>
					<li>объектов критической информационной инфраструктуры</li>
				</ul>
				<ul class="catalog-description-block__list">
					<li>систем управления технологическими процессами (АСУ ТП)</li>
					<li>крупных территориально-распределенных сетей</li>
					<li>IP-телефонии, видеонаблюдения, видеоконференцсвязи, СКУД</li>
					<li>подключения к СМЭВ</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="catalog-compl-sertificates">
		<div class="catalog-compl-sertificates__wrap">
			<div class="catalog-compl-sertificates__title">Свидетельства на программы для ЭВМ и базы данных</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"cert-slider1",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_PICTURE",
						2 => "DETAIL_PICTURE",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "54",
					"IBLOCK_TYPE" => "products",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "20",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "PRODUCT",
						2 => "TYPE",
						3 => "FILE",
						4 => "",
						5 => "",
						6 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "DESC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "cert-slider1"
				),
				false
			);?>
			<div class="catalog-compl-sertificates-slider__control js-slider-control-2">
				<button class="btn btn-primary-inverse btn-round" data-controls="prev">
					<svg width="7" height="12">
						<use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
					</svg>
				</button>
				<button class="btn btn-primary-inverse btn-round" data-controls="next">
					<svg width="7" height="12">
						<use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
					</svg>
				</button><a class="btn btn-primary-inverse" href="/support/documentation/svidetelstva-na-po/">Все свидетельства</a>
			</div>
		</div>
	</div>