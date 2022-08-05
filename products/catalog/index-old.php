<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Продуктовая линейка");

// Products count
$arFilter = [
	"IBLOCK_ID"      => 7,
	"DEPTH_LEVEL"    => 2,
	"=ACTIVE"        => "Y",
	"=GLOBAL_ACTIVE" => "Y",
];
$count = CIBlockSection::GetCount($arFilter);

$obCache = new \CPHPCache();
if( $obCache->InitCache((60 * 60 * 24), "catalog_products_page") ) {
	$arProducts = $obCache->GetVars();
}
else {
	$obCache->StartDataCache();
	$arProducts = [];
	$q = new \Bitrix\Main\Entity\Query(\Bitrix\Iblock\Model\Section::compileEntityByIblock(7));
	$q
		->setSelect(
			[
				'ID',
				'CODE',
				'NAME',
				'DETAIL_PICTURE',
				'SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
				"UF_SHORT_DESCRIPTION",
				"UF_DESIGN",
				"UF_CERT_CLASS",
				/*"UF_PRODUCTS_LINE",
				"UF_CERTIFICATION",
				"UF_DOCUMENT",
				"UF_CURRENT_VERSION",
				"UF_MENU_NAME",*/
			]
		)
		->setFilter($arFilter)
		->setLimit(10);
	$rsSection = $q->exec();

	while( $arSection = $rsSection->fetch() ) {
		$arSection['URL'] =
			str_replace(["#SITE_DIR#", "#SECTION_CODE#"], ["", $arSection['CODE']], $arSection['SECTION_PAGE_URL']);
		$arSection['ICON'] = CFile::GetPath($arSection['DETAIL_PICTURE']);
		$arProducts[] = $arSection;
	}
	$obCache->EndDataCache($arProducts);
}
?>
	<div class="catalog-product-page">
		<main class="page-main">
			<div class="bg-block">
				<div class="catalog-compl-page__jumbotron"><!-- JUMBOTRON -->
					<div class="jumbotron">
						<div class="container">
							<div class="home-banner">
								<div class="home-banner__content">
									<div class="home-banner__text">Продуктовая линейка компании «С-Терра СиЭсПи»</div>
									<div class="home-banner__description">
										<p>Позволяет защитить информационную систему любого масштаба: от небольшой локальной сети до инфраструктуры федерального уровня.</p>
										<p>Основой защиты передаваемых данных служит технология IPsec VPN, надежность и безопасность которой подтверждена многолетним мировым опытом.</p>
									</div><a class="btn btn-accent" href="" download>
										<svg class="btn-icon">
											<use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow"></use>
										</svg>
										<svg class="btn-icon mobile">
											<use href="<?=SITE_TEMPLATE_PATH?>/images/icons/icon-sprite.svg#download-arrow-mobile"></use>
										</svg><span>Каталог продукции</span></a>
								</div>
								<div class="home-banner__img"><img src="<?=SITE_TEMPLATE_PATH?>/images/catalog-product/main.png" alt=""></div>
							</div>
						</div>
					</div><!-- /JUMBOTRON -->
				</div>
			</div>
		</main>
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			".default",
			Array(
				"START_FROM" => "1",
				"PATH" => "",
				"SITE_ID" => SITE_ID,
			),
			false
		);?>
		<div class="catalog-block">
			<div class="container">
				<div class="catalog-block__content js-catalog" data-full-length="<?=$count?>" data-page-size="10" data-page-size-mobile="5" data-action="/local/ajax/catalog-product.php" data-method="GET">
					<div class="catalog-block__top">
						<div class="catalog-block__title">Каталог</div>
						<ul class="catalog-block__filter">
							<li class="catalog-block__filter__item"><a class="catalog-block__filter__button active" data-type="" href="/catalog/products/">Продукты</a></li>
							<li class="catalog-block__filter__item"><a class="catalog-block__filter__button" data-type="1" href="/catalog/complex_solutions/">Комплексные решения</a></li>
							<li class="catalog-block__filter__item"><a class="catalog-block__filter__button" data-type="2" href="/catalog/industry_solutions/">Отраслевые решения</a></li>
						</ul>
					</div>
					<div class="catalog-block__grid">
						<div class="catalog-block__filter-col">
							<div class="catalog-block__filter-col__top">
								<button class="btn btn-primary-inverse btn-mobile btn-filter">
									<svg width="16" height="15">
										<use xlink:href="#i-filter-icon" href="#i-filter-icon"></use>
									</svg><span>Фильтр</span>
								</button>
								<div class="catalog-block__filter-col__search">
									<div class="search-field js-input-search-field">
										<div class="search-field__icon">
											<svg width="14" height="14">
												<use xlink:href="#i-search" href="#i-search"></use>
											</svg>
										</div>
										<input class="js-input-search form-control" value="" placeholder="Поиск" name="q" data-field autocomplete="off" data-js-ref="catalog-filter-search">
										<button class="js-input-search-clear icon-btn search-field__reset" type="button" data-reset>
											<svg width="10" height="10">
												<use xlink:href="#i-times" href="#i-times"></use>
											</svg>
										</button>
									</div>
								</div>
							</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"catalog",
								array(
									"ROOT_MENU_TYPE" => "left",
									"MAX_LEVEL" => "3",
									"CHILD_MENU_TYPE" => "left",
									"USE_EXT" => "Y",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => ""
								),
								false,
								array(
									"ACTIVE_COMPONENT" => "Y"
								)
							);?>
							<div class="catalog-block__filter-col__checkboxes">
								<div class="catalog-block__filter-col__checkboxes__item">
									<div class="catalog-block__filter-col__checkboxes__item__title">Класс сертификации</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_1" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> КС1</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_2" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> КС2</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_3" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> КС3</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_4" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> МЭ А4 / Б4 4 ур. доверия</div>
										</label>
									</div>
								</div>
								<div class="catalog-block__filter-col__checkboxes__item">
									<div class="catalog-block__filter-col__checkboxes__item__title">Назначение</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_5" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> Корпоративная сеть</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_6" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> Удаленный доступ</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_7" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> Мобильный доступ</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_8" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> ЦОД, СХД, высокопроизводительные каналы</div>
										</label>
									</div>
									<div class="form-field">
										<label class="checkbox">
											<input type="checkbox" name="filter_9" data-js-ref="catalog-checkbox-filter">
											<div class="checkbox-box"></div>
											<div class="checkbox-label"> Виртуальная среда</div>
										</label>
									</div>
								</div>
								<div class="catalog-block__filter-col__checkboxes__buttons">
									<button class="btn btn-primary-inverse js-clear-filters">Сбросить</button>
									<button class="btn btn-primary js-apply-filters">Применить</button>
								</div>
							</div>
						</div>
						<div class="catalog-block__items">
							<div class="catalog-block__items__choosen" data-js-ref="catalog-choosen-block">
								<div class="catalog-block__items__choosen__wrap" data-js-ref="catalog-choosen-container">
									<!--.catalog-block__items__choosen-item-->
									<!--    span.catalog-block__items__choosen-item__text  КС1-->
									<!--    .catalog-block__items__choosen-item__close-->
									<!--        +svg-icon('chest-filter', 10, 10)-->
									<!--.catalog-block__items__choosen-item-->
									<!--    span.catalog-block__items__choosen-item__text  ЦОД, СХД, высокопроизводительные каналы-->
									<!--    .catalog-block__items__choosen-item__close-->
									<!--        +svg-icon('chest-filter', 10, 10)-->
									<!--.catalog-block__items__choosen-item-->
									<!--    span.catalog-block__items__choosen-item__text  Мобильный доступ-->
									<!--    .catalog-block__items__choosen-item__close-->
									<!--        +svg-icon('chest-filter', 10, 10)-->
									<!--.catalog-block__items__choosen-item-->
									<!--    span.catalog-block__items__choosen-item__text  Удаленный доступ-->
									<!--    .catalog-block__items__choosen-item__close-->
									<!--        +svg-icon('chest-filter', 10, 10)-->
								</div>
								<div class="catalog-block__items__choosen__clear" data-js-ref="catalog-choosen-clear">Сбросить все</div>
							</div>
							<div class="catalog-block__items__wrap" data-js-ref="items-container">
								<? foreach($arProducts as $arItem) { ?>
									<div class="industry-card-items__item">
										<div class="industry-card-items__item__wrap">
											<div class="industry-card-items__item__title"><?=$arItem["NAME"]?></div>
											<div class="industry-card-items__item__description"><?=$arItem["UF_SHORT_DESCRIPTION"]?></div>
											<div class="industry-card-items__item__blocks">
												<? if($arItem["UF_DESIGN"] != "") { ?>
												<div class="industry-card-items__item__block">
													<div class="industry-card-items__item__block__title">Исполнения</div>
													<div class="industry-card-items__item__block__value"><?=$arItem["UF_DESIGN"]?></div>
												</div>
												<? } ?>
												<? if($arItem["UF_CERT_CLASS"] != "") { ?>
												<div class="industry-card-items__item__block">
													<div class="industry-card-items__item__block__title">Классы сертификации СКЗИ</div>
													<div class="industry-card-items__item__block__value"><?=$arItem["UF_CERT_CLASS"]?></div>
												</div>
												<? } ?>
											</div>
											<div class="industry-card-items__item__footer">
												<div class="industry-card-items__item__footer__image"><img src="<?=$arItem["ICON"]?>"></div><a class="btn btn-primary-inverse" href="<?=$arItem["URL"]?>">Подробнее</a>
											</div>
										</div>
									</div>
								<? } ?>
							</div>
							<div class="catalog-block__controll">
								<div class="catalog-block__controll__text js-control-text"></div>
								<button class="js-control-more catalog-block__controll__btn btn btn-primary-inverse"></button>
							</div>
						</div>
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
		<div class="catalog-compl-sertificates catalog-compl-sertificates-2">
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
					</button><a class="btn btn-primary-inverse" href="#">Все свидетельства</a>
				</div>
			</div>
		</div><!-- CONTACT FORM -->
		<div class="home-contact-form catalog-form">
			<div class="container">
				<h2 class="home-contact-form__title">Закажите бесплатную консультацию</h2>
				<div class="home-contact-form__subtitle">Оставьте свои контакты, мы свяжемся с вами в ближайшее время</div>
			</div>
			<div class="container">
				<div class="home-contact-form__wrapper">
					<div class="home-contact-form__image"><img src="<?=SITE_TEMPLATE_PATH?>/images/icons/contacts.png" width="405"></div>
					<form class="home-contact-form__fields" id="home-contact-form" action="/local/ajax/contact-form.php" method="GET">
						<div class="form-field">
							<input class="form-control" type="text" name="name" placeholder="ФИО*">
						</div>
						<div class="form-field">
							<input class="form-control" type="text" name="company" placeholder="Название компании*">
						</div>
						<div class="form-field">
							<input class="form-control" type="text" name="email" placeholder="Электронная почта*" inputmode="email">
						</div>
						<div class="form-field">
							<input class="form-control" data-mask="phone" type="text" name="phone" placeholder="Номер телефона*" inputmode="number">
						</div>
						<div class="form-field">
							<textarea class="form-control" name="comment" placeholder="Комментарий"></textarea>
						</div>
						<div class="form-field home-contact-form__confirm">
							<label class="checkbox">
								<input type="checkbox" name="agreement"><span class="checkbox-box"></span>
								<div class="checkbox-label">Даю согласие на обработку своих персональных данных в соответствии с <a href="#">Политикой обработки персональных данных ООО «С-Терра СиЭсПи»</a>.</div>
							</label>
						</div>
						<div class="home-contact-form__submit">
							<button class="btn btn-primary btn-block" type="submit">Отправить</button>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /CONTACT FORM -->
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>